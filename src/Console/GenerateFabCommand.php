<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\BuildConfiguration;
use Neighborhoods\Prefab\HttpSkeleton;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class GenerateFabCommand extends Command implements GenerateFabCommandInterface
{
    use HttpSkeleton\Generator\Factory\AwareTrait;
    use BuildConfiguration\Builder\Factory\AwareTrait;

    /** @var string */
    protected $daoName;
    /** @var string */
    protected $daoNamespace;
    /** @var string */
    protected $daoRelativePath;
    /** @var string */
    protected $httpSrcDir;
    /** @var string */
    protected $stagedHttpDir;
    /** @var string */
    protected $projectDir;
    /** @var string */
    protected $fabLocation;
    /** @var string */
    protected $srcLocation;
    /** @var string */
    protected $projectName;

    protected function configure() : GenerateFabCommandInterface
    {
        $this->setName('gen:fab')
            ->setDescription('Generate Protean Machinery');

        // We should probably do something better than this
        $this->httpSrcDir = __DIR__ . '/../../http';
        $this->stagedHttpDir = __DIR__ . '/../../stagedHttp';
        $this->projectDir = __DIR__ . '/../../../../../';
        $this->srcLocation = $this->projectDir . 'src/';
        $this->fabLocation = $this->projectDir . 'fab/';

        return $this;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : GenerateFabCommandInterface
    {
        $this->setProjectName($this->getProjectNameFromComposer());

//        $output->writeln('Copying HTTP skeleton.');
//        $this->generateHttpSkeleton();

        $output->writeln('Assembling Prefab build plan.');
        $this->generateBuildPlan();

        $output->writeln('Generating prefab machinery.');
        $this->generatePrefab();

        $output->writeln('Protean prefab complete.');

        return $this;
    }

    protected function generateBuildPlan() : GenerateFabCommand
    {
        $configurations = [];
        $finder = new Finder();
        $daos = $finder->files()->name('*.dao.yml')->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $configurations[] = $this->getBuildConfigurationBuilderFactory()->create()
                ->setYamlFilePath($dao->getPath() . '/' . $dao->getFilename())
                ->build();
        }
    }

    protected function generateHttpSkeleton() : GenerateFabCommandInterface
    {
        $generator = $this->getHttpSkeletonGeneratorFactory()->create();
        $generator->setProjectName($this->getProjectName())
            ->setSrcDirectory($this->srcLocation)
            ->setHttpSourceDirectory($this->httpSrcDir)
            ->setTargetDirectory($this->projectDir)
            ->generate();

        return $this;
    }

    protected function getProjectNameFromComposer() : string
    {
        $finder = new Finder();
        $finder->name('composer.json')->in($this->projectDir)->exclude('vendor');

        $matchCount = $finder->count();
        if ($matchCount < 1) {
            throw new \RuntimeException('Could not find composer file for project.');
        } elseif ($matchCount > 1) {
            throw new \RuntimeException('Found more than one composer file.');
        } else {
            $iterator = $finder->getIterator();
            $iterator->rewind();
            $composerFile = $iterator->current();
        }

        if (!$composerFile) {
            throw new \RuntimeException('Could not access composer file for project.');
        }

        $composerContents = json_decode($composerFile->getContents(), true);
        $fullNamespace = key($composerContents['autoload']['psr-4']);
        $projectName = trim(str_replace('Neighborhoods', '', $fullNamespace), '\\');

        return $projectName;
    }

    protected function generatePrefab() : GenerateFabCommandInterface
    {
        $generatorList = $this->getBuildPlan();
        /** @var GeneratorInterface $generator */
        foreach ($generatorList as $generator) {
            $generator->generate();
        }

        return $this;
    }


    protected function getBuildPlan() : array
    {
        if ($this->buildPlan === null) {
            throw new \LogicException('GenerateFabCommand buildPlan has not been set.');
        }
        return $this->buildPlan;
    }

    public function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('GenerateFabCommand projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : GenerateFabCommandInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('GenerateFabCommand projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }
}

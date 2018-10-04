<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\Actor\AwareTrait;
use Neighborhoods\Prefab\Actor\Builder;
use Neighborhoods\Prefab\Actor\BuilderInterface;
use Neighborhoods\Prefab\Actor\Factory;
use Neighborhoods\Prefab\Actor\FactoryInterface;
use Neighborhoods\Prefab\Actor\Handler;
use Neighborhoods\Prefab\Actor\HandlerInterface;
use Neighborhoods\Prefab\Actor\MapBuilder;
use Neighborhoods\Prefab\Actor\MapBuilderInterface;
use Neighborhoods\Prefab\Actor\Map;
use Neighborhoods\Prefab\Actor\MapInterface;
use Neighborhoods\Prefab\Actor\Repository;
use Neighborhoods\Prefab\Actor\RepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class GenerateFabCommand extends Command implements GenerateFabCommandInterface
{
    use AwareTrait\Generator\Factory\AwareTrait;
    use Builder\Generator\Factory\AwareTrait;
    use BuilderInterface\Generator\Factory\AwareTrait;
    use Factory\Generator\Factory\AwareTrait;
    use FactoryInterface\Generator\Factory\AwareTrait;
    use Handler\Generator\Factory\AwareTrait;
    use HandlerInterface\Generator\Factory\AwareTrait;
    use Map\Generator\Factory\AwareTrait;
    use MapBuilder\Generator\Factory\AwareTrait;
    use MapBuilderInterface\Generator\Factory\AwareTrait;
    use MapInterface\Generator\Factory\AwareTrait;
    use Repository\Generator\Factory\AwareTrait;
    use RepositoryInterface\Generator\Factory\AwareTrait;
    use GeneratorMeta\Factory\AwareTrait;

    const FORWARD_SLASH = '/';
    const BACKSLASH = '\\';

    /** @var array */
    protected $buildPlan = [];
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
        $this->srcLocation = __DIR__ . '/../../../../../src';
        $this->fabLocation = __DIR__ . '/../../../../../fab';

        return $this;
    }

    protected function execute(InputInterface $input, OutputInterface $output) : GenerateFabCommandInterface
    {
        $output->writeln('Copying HTTP skeleton.');
        $this->copyHttpSkeleton();

        $output->writeln('Assembling Prefab build plan.');
        $this->assembleBuildPlan();

        $output->writeln('Generating prefab machinery.');
        $this->generatePrefab();

        $output->writeln('Protean prefab complete.');

        return $this;
    }

    protected function copyHttpSkeleton() : GenerateFabCommandInterface
    {
        $fileSystem = new Filesystem();

        $options['override'] = true;

        $fileSystem->mkdir($this->stagedHttpDir);
        $fileSystem->mirror($this->httpSrcDir, $this->stagedHttpDir, null, $options);

        $this->determineProjectNameFromComposer();
        $this->setProjectNameInStagedHttpFiles();

        $finder = new Finder();
        $httpDirs = $finder->directories()->in($this->stagedHttpDir);

        /** @var SplFileInfo $dir */
        foreach ($httpDirs as $dir) {
            $dirName = $this->projectDir . $dir->getFilename();
            if ($fileSystem->exists($dirName)) {
                $fileSystem->remove($dirName);
            }
        }

        $fileSystem->mirror($this->stagedHttpDir, $this->projectDir, null, $options);
        $fileSystem->remove($this->stagedHttpDir);

        return $this;
    }

    protected function determineProjectNameFromComposer() : GenerateFabCommandInterface
    {
        $finder = new Finder();
        $finder->name('composer.json')->in($this->projectDir)->exclude('vendor');

        $matchCount = $finder->count();
        if ($matchCount < 1) {
            throw new \RuntimeException('Could not find composer file for project.');
        } elseif ($matchCount > 1) {
            throw new \RuntimeException('Found too many composer files.');
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

        $this->setProjectName($projectName);

        return $this;
    }

    protected function setProjectNameInStagedHttpFiles() : GenerateFabCommandInterface
    {
        $finder = new Finder();
        $finder->files()->in($this->stagedHttpDir);

        foreach ($finder as $file) {
            $contents = $file->getContents();
            $modifiedContents = str_replace('ReplaceThisWithTheNameOfYourProduct', $this->getProjectName(), $contents);
            file_put_contents($file->getRealPath(), $modifiedContents);
        }

        return $this;
    }

    protected function assembleBuildPlan() : GenerateFabCommandInterface
    {
        $daoAnnotationPattern = '#@neighborhoods\\\prefab:DAO\n#s';

        $finder = new Finder();
        $daos = $finder->files()->contains($daoAnnotationPattern)->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $daoName = $dao->getBasename('.php');
            $daoFilePath = $this->fabLocation . self::FORWARD_SLASH . $dao->getRelativePath();
            $daoNamespace = $this->getDaoNamespaceFromFile($dao);

            $daoMeta = $this->getConsoleGeneratorMetaFactory()->create();
            $daoMeta->setDaoName($daoName);
            $daoMeta->setActorNamespace($daoNamespace);
            $daoMeta->setActorFilePath($daoFilePath);

            $this->addDaoToPlan($daoMeta);
        }

        return $this;
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

    protected function getDaoNamespaceFromFile(SplFileInfo $dao) : string
    {
        preg_match('#namespace (.*?);#s', $dao->getContents(), $namespace);

        return $namespace[1];
    }

    protected function getPrefabAnnotations(SplFileInfo $file) : array
    {
        preg_match_all('#@neighborhoods\\\prefab:(.*?)\n#s', $file->getContents(), $annotations);
        return $annotations[1];
    }

    protected function addDaoToPlan(GeneratorMetaInterface $daoMeta) : GenerateFabCommandInterface
    {
        /** @todo DAO generator logic + Service.yml */

        $nextLevelNamespace = $daoMeta->getActorNamespace() . self::BACKSLASH . $daoMeta->getDaoName();
        $nextLevelFilePath = $daoMeta->getActorFilePath() . self::FORWARD_SLASH . $daoMeta->getDaoName();

        // Once we have a DAO generator, we can pass it to getNextLevelMeta() instead of setting it all here.
        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($daoMeta->getDaoName());

        //$this->addServiceToPlan($daoMeta);
        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);
        $this->addMapToPlan($nextLevelMeta);
        $this->addRepositoryToPlan($nextLevelMeta);
        $this->addRepositoryInterfaceToPlan($nextLevelMeta);
        $this->addBuilderToPlan($nextLevelMeta);
        $this->addBuilderInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addAwareTraitToPlan(GeneratorMetaInterface $meta) : GenerateFabCommandInterface
    {
        $awareTraitGenerator = $this->getActorAwareTraitGeneratorFactory()->create();
        $awareTraitGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($awareTraitGenerator);

        return $this;
    }

    protected function addBuilderToPlan(GeneratorMetaInterface $builderMeta) : GenerateFabCommandInterface
    {
        $builderGenerator = $this->getActorBuilderGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapBuilderToPlan(GeneratorMetaInterface $builderMeta) : GenerateFabCommandInterface
    {
        $builderGenerator = $this->getActorMapBuilderGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapBuilderInterfaceToPlan(GeneratorMetaInterface $builderMeta) : GenerateFabCommandInterface
    {
        $builderGenerator = $this->getActorMapBuilderInterfaceGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        return $this;
    }

    protected function addBuilderInterfaceToPlan(GeneratorMetaInterface $builderInterfaceMeta) : GenerateFabCommandInterface
    {
        $builderInterfaceGenerator = $this->getActorBuilderInterfaceGeneratorFactory()->create();
        $builderInterfaceGenerator->setMeta($builderInterfaceMeta);
        $this->appendGeneratorToBuildPlan($builderInterfaceGenerator);

        return $this;
    }

    protected function addFactoryToPlan(GeneratorMetaInterface $factoryMeta) : GenerateFabCommandInterface
    {
        $factoryGenerator = $this->getActorFactoryGeneratorFactory()->create();
        $factoryGenerator->setMeta($factoryMeta);
        $this->appendGeneratorToBuildPlan($factoryGenerator);
        $this->addFactoryInterfaceToPlan($factoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($factoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);

        return $this;
    }

    protected function addFactoryInterfaceToPlan(GeneratorMetaInterface $factoryInterfaceMeta) : GenerateFabCommandInterface
    {
        $factoryInterfaceGenerator = $this->getActorFactoryInterfaceGeneratorFactory()->create();
        $factoryInterfaceGenerator->setMeta($factoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($factoryInterfaceGenerator);
        return $this;
    }

    protected function addHandlerToPlan(GeneratorMetaInterface $handlerMeta) : GenerateFabCommandInterface
    {
        $handlerGenerator = $this->getActorHandlerGeneratorFactory()->create();
        $handlerGenerator->setMeta($handlerMeta);
        $this->appendGeneratorToBuildPlan($handlerGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($handlerGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        return $this;
    }

    protected function addHandlerInterfaceToPlan(GeneratorMetaInterface $handlerInterfaceMeta) : GenerateFabCommandInterface
    {
        $handlerInterfaceGenerator = $this->getActorHandlerInterfaceGeneratorFactory()->create();
        $handlerInterfaceGenerator->setMeta($handlerInterfaceMeta);
        $this->appendGeneratorToBuildPlan($handlerInterfaceGenerator);
        return $this;
    }

    protected function addMapToPlan(GeneratorMetaInterface $mapMeta) : GenerateFabCommandInterface
    {
        $mapGenerator = $this->getMapGeneratorFactory()->create();
        $mapGenerator->setMeta($mapMeta);
        $this->appendGeneratorToBuildPlan($mapGenerator);
        $this->addMapInterfaceToPlan($mapMeta);

        $nextLevelMeta = $this->getNextLevelMeta($mapGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addMapBuilderToPlan($nextLevelMeta);
        $this->addMapBuilderInterfaceToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapInterfaceToPlan(GeneratorMetaInterface $mapInterfaceMeta) : GenerateFabCommandInterface
    {
        $mapInterfaceGenerator = $this->getMapInterfaceGeneratorFactory()->create();
        $mapInterfaceGenerator->setMeta($mapInterfaceMeta);
        $this->appendGeneratorToBuildPlan($mapInterfaceGenerator);

        return $this;
    }


    protected function addRepositoryToPlan(GeneratorMetaInterface $repositoryMeta) : GenerateFabCommandInterface
    {
        $repositoryGenerator = $this->getActorRepositoryGeneratorFactory()->create();
        $repositoryGenerator->setMeta($repositoryMeta);
        $this->appendGeneratorToBuildPlan($repositoryGenerator);
        $this->addRepositoryInterfaceToPlan($repositoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($repositoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addHandlerToPlan($nextLevelMeta);
        $this->addHandlerInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addRepositoryInterfaceToPlan(GeneratorMetaInterface $repositoryInterfaceMeta) : GenerateFabCommandInterface
    {
        $repositoryInterfaceGenerator = $this->getActorRepositoryInterfaceGeneratorFactory()->create();
        $repositoryInterfaceGenerator->setMeta($repositoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($repositoryInterfaceGenerator);

        return $this;
    }

    protected function addServiceToPlan(GeneratorMetaInterface $serviceMeta) : GenerateFabCommandInterface
    {
        /** @todo Service generator logic */

        return $this;
    }

    protected function getNextLevelMeta(GeneratorInterface $parentGenerator) : GeneratorMetaInterface
    {
        $parentMeta = $parentGenerator->getMeta();
        $actorName = $parentGenerator->getActorName();
        $nextLevelNamespace = $parentMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $parentMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($parentMeta->getDaoName());

        return $nextLevelMeta;
    }

    protected function appendGeneratorToBuildPlan(GeneratorInterface $generator) : GenerateFabCommandInterface
    {
        $this->buildPlan[] = $generator;
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

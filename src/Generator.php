<?php


namespace Neighborhoods\Prefab;

use Neighborhoods\Prefab\HttpSkeleton;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Generator implements GeneratorInterface
{
    use HttpSkeleton\Generator\Factory\AwareTrait;
    use BuildConfiguration\Builder\Factory\AwareTrait;
    use BuildPlan\Builder\Factory\AwareTrait;

    protected $buildPlans;
    protected $daoName;
    protected $daoNamespace;
    protected $daoRelativePath;
    protected $httpSrcDir;
    protected $stagedHttpDir;
    protected $projectDir;
    protected $fabLocation;
    protected $srcLocation;
    protected $projectName;

    protected function configure()
    {
        $this->setHttpSrcDir(__DIR__ . '/../http');
        $this->setStagedHttpDir(__DIR__ . '/../stagedHttp');

        $this->setSrcLocation($this->projectDir . 'src/');
        $this->setFabLocation( $this->projectDir . 'fab/');

        return $this;
    }

    public function generate()
    {
        $this->configure();
        $this->setProjectName($this->getProjectNameFromComposer());

        echo "\n";
        echo ">> Copying the skeleton...\n";
        $this->generateHttpSkeleton();
        echo ">> Success.\n";

        echo ">> Assembling the Prefab build plan...\n";
        $this->generateBuildPlan();
        echo ">> Success.\n";

        echo ">> Generating Prefab machinery...\n";
        $this->generatePrefab();
        echo ">> Success.\n";

        echo ">> Protean Prefab complete.\n";
        echo "\n";

        return $this;
    }

    protected function generateBuildPlan() : GeneratorInterface
    {
        $finder = new Finder();
        $daos = $finder->files()->name('*' . BuildPlan\Builder::DAO_YML_SUFFIX)->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $configuration = $this->getBuildConfigurationBuilderFactory()->create()
                ->setYamlFilePath($dao->getPath() . '/' . $dao->getFilename())
                ->setProjectName($this->getProjectName())
                ->build();

            $this->appendBuildPlan(
                $this->getBuildPlanBuilderFactory()->create()
                    ->setBuildConfiguration($configuration)
                    ->build()
            );
        }

        return $this;
    }

    protected function generateHttpSkeleton() : GeneratorInterface
    {
        $generator = $this->getHttpSkeletonGeneratorFactory()->create();
        $generator->setProjectName($this->getProjectName())
            ->setSrcDirectory($this->srcLocation)
            ->setHttpSourceDirectory($this->httpSrcDir)
            ->setTargetDirectory($this->projectDir)
            ->generate();

        return $this;
    }

    protected function generatePrefab() : GeneratorInterface
    {
        /** @var BuildPlanInterface $buildPlan */
        foreach ($this->getBuildPlans() as $buildPlan) {
            $buildPlan->execute();
        }

        return $this;
    }

    protected function getProjectNameFromComposer() : string
    {
        $finder = new Finder();
        $finder->name('composer.json')->in($this->projectDir)->depth('== 0');

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

    protected function getProjectName() : string
    {
        if ($this->projectName === null) {
            throw new \LogicException('Generator projectName has not been set.');
        }
        return $this->projectName;
    }

    public function setProjectName(string $projectName) : GeneratorInterface
    {
        if ($this->projectName !== null) {
            throw new \LogicException('Generator projectName is already set.');
        }
        $this->projectName = $projectName;
        return $this;
    }

    protected function getProjectDir() : string
    {
        if ($this->projectDir === null) {
            throw new \LogicException('Generator projectDir has not been set.');
        }
        return $this->projectDir;
    }

    public function setProjectDir(string $projectDir) : GeneratorInterface
    {
        if ($this->projectDir !== null) {
            throw new \LogicException('Generator projectDir is already set.');
        }
        $this->projectDir = $projectDir;
        return $this;
    }

    protected function getBuildPlans() : array
    {
        if ($this->buildPlans === null) {
            throw new \LogicException('Generator buildPlans has not been set.');
        }
        return $this->buildPlans;
    }

    public function appendBuildPlan(BuildPlanInterface $buildPlan) : GeneratorInterface
    {
        $this->buildPlans[] = $buildPlan;
        return $this;
    }

    protected function getHttpSrcDir() : string
    {
        if ($this->httpSrcDir === null) {
            throw new \LogicException('Generator httpSrcDir has not been set.');
        }
        return $this->httpSrcDir;
    }

    public function setHttpSrcDir(string $httpSrcDir) : GeneratorInterface
    {
        if ($this->httpSrcDir !== null) {
            throw new \LogicException('Generator httpSrcDir is already set.');
        }
        $this->httpSrcDir = $httpSrcDir;
        return $this;
    }

    protected function getStagedHttpDir() : string
    {
        if ($this->stagedHttpDir === null) {
            throw new \LogicException('Generator stagedHttpDir has not been set.');
        }
        return $this->stagedHttpDir;
    }

    public function setStagedHttpDir(string $stagedHttpDir) : GeneratorInterface
    {
        if ($this->stagedHttpDir !== null) {
            throw new \LogicException('Generator stagedHttpDir is already set.');
        }
        $this->stagedHttpDir = $stagedHttpDir;
        return $this;
    }

    protected function getFabLocation() : string
    {
        if ($this->fabLocation === null) {
            throw new \LogicException('Generator fabLocation has not been set.');
        }
        return $this->fabLocation;
    }

    public function setFabLocation(string $fabLocation) : GeneratorInterface
    {
        if ($this->fabLocation !== null) {
            throw new \LogicException('Generator fabLocation is already set.');
        }
        $this->fabLocation = $fabLocation;
        return $this;
    }

    protected function getSrcLocation() : string
    {
        if ($this->srcLocation === null) {
            throw new \LogicException('Generator srcLocation has not been set.');
        }
        return $this->srcLocation;
    }

    public function setSrcLocation(string $srcLocation) : GeneratorInterface
    {
        if ($this->srcLocation !== null) {
            throw new \LogicException('Generator srcLocation is already set.');
        }
        $this->srcLocation = $srcLocation;
        return $this;
    }
}

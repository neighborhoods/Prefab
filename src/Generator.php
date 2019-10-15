<?php


namespace Neighborhoods\Prefab;

use Neighborhoods\Prefab\HttpSkeleton;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;
use Neighborhoods\Prefab;
use Neighborhoods\Bradfab\Bradfab;
use Neighborhoods\Bradfab\Protean\Container\Builder;
use Neighborhoods\Prefab\SupportingActorGroup;

class Generator implements GeneratorInterface
{
    use HttpSkeleton\Generator\Factory\AwareTrait;
    use BuildConfiguration\Builder\Factory\AwareTrait;
    use BuildPlan\Builder\Factory\AwareTrait;
    use Prefab\Bradfab\Template\Factory\AwareTrait;
    use SupportingActorGroup\AllSupportingActors\Factory\AwareTrait;
    use SupportingActorGroup\Collection\Factory\AwareTrait;
    use SupportingActorGroup\Minimal\Factory\AwareTrait;

    protected $buildPlans;
    protected $httpSrcDir;
    protected $stagedHttpDir;
    protected $projectRoot;
    protected $fabLocation;
    protected $srcLocation;
    protected $projectName;
    protected $fileSystem;
    protected $bradFabricator;

    protected function configure()
    {
        $this->setHttpSrcDir(__DIR__ . '/../http');
        $this->setStagedHttpDir(__DIR__ . '/../stagedHttp');

        $this->setSrcLocation($this->getProjectRoot() . 'src/');
        $this->setFabLocation($this->getProjectRoot() . 'fab/');

        return $this;
    }

    public function generate()
    {
        $this->configure();
        $this->setProjectName($this->getProjectNameFromComposer());

        echo PHP_EOL . ">> Copying the skeleton...";
        $this->generateHttpSkeleton();

        echo ">> Assembling the Prefab build plan...";
        $this->generateBuildPlan();

        echo ">> Generating Prefab machinery...";
        $this->generatePrefabActors();

        echo PHP_EOL . "\e[0;32mPrefab complete.\e[0m" . PHP_EOL;

        return $this;
    }

    protected function generateBuildPlan() : GeneratorInterface
    {
        $finder = new Finder();
        $daos = $finder->files()->name('*' . BuildPlan\Builder::DAO_YML_SUFFIX)->in($this->srcLocation);

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $configuration = $this->getBuildConfigurationBuilderFactory()->create()
                ->setYamlFilePath($dao->getRealPath())
                ->setProjectName($this->getProjectName())
                ->setProjectRoot($this->getProjectRoot())
                ->build();

            $this->generateBradfabTemplate($configuration, $dao);
            $this->appendBuildPlan(
                $this->getBuildPlanBuilderFactory()->create()
                    ->setBuildConfiguration($configuration)
                    ->build()
            );
        }

        echo "\e[0;32m success. \e[0m" . PHP_EOL;

        return $this;
    }

    protected function generateBradfabTemplate(BuildConfigurationInterface $configuration, SplFileInfo $dao) : GeneratorInterface
    {
        $configArray = $this->getSupportingActorConfigForBuildConfiguration($configuration, $this->getNameForDao($dao));

        $writeFilePath = $this->getWritePathForDao($dao);
        $directory = $this->getWriteDirectoryForDao($writeFilePath);

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $yaml = Yaml::dump($configArray, 10);
        file_put_contents($writeFilePath, $yaml);

        return $this;
    }

    protected function getSupportingActorConfigForBuildConfiguration(BuildConfigurationInterface $buildConfiguration, string $daoName) : array
    {
        switch ($buildConfiguration->getSupportingActorGroup()) {
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COMPLETE:
                return $this->getAllSupportingActorsFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->setDaoName($daoName)
                    ->getSupportingActorConfig();
                break;
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COLLECTION:
                return $this->getCollectionFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->setDaoName($daoName)
                    ->getSupportingActorConfig();
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_MINIMAL:
                return $this->getMinimalFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->setDaoName($daoName)
                    ->getSupportingActorConfig();
            default:
                throw new \RuntimeException('Invalid supporting actor group ' . $buildConfiguration->getSupportingActorGroup());
        }
    }

    protected function getNameForDao(SplFileInfo $dao) : string
    {
        $name = explode('/src/', $dao->getRealPath())[1];
        $name = implode('', explode('/', $name));
        $name = str_replace('.prefab.definition.yml', '', $name);

        return $name;
    }
    protected function generateHttpSkeleton() : GeneratorInterface
    {
        $generator = $this->getHttpSkeletonGeneratorFactory()->create();
        $generator->setProjectName($this->getProjectName())
            ->setSrcDirectory($this->getSrcLocation())
            ->setHttpSourceDirectory($this->getHttpSrcDir())
            ->setTargetDirectory($this->getProjectRoot())
            ->generate();

        echo "\e[0;32m success. \e[0m" . PHP_EOL;

        return $this;
    }

    protected function generatePrefabActors() : GeneratorInterface
    {
        if ($this->hasBuildPlans()) {
            foreach ($this->getBuildPlans() as $buildPlan) {
                $buildPlan->execute();
            }

            $this->getBradFabricator()
                ->setProjectName($this->getProjectName())
                ->setProjectRoot($this->getProjectRoot())
                ->fabricateSupportingActors();

            echo "\e[0;32m success. \e[0m" . PHP_EOL;
        } else {
            echo "\e[1;33m skipped. \e[0m" . PHP_EOL;
            echo PHP_EOL . "\e[0;30;43mNo Prefab definition files found in " . $this->getSrcLocation() . "\e[0m" . PHP_EOL;
            echo "\e[1;33mNote:\e[0m Prefab definition files cannot be saved in the root of src/." .
                " They MUST be located in a versioned directory under src/" . PHP_EOL;
        }

        return $this;
    }

    protected function getProjectNameFromComposer() : string
    {
        $composerFilePath = $this->getProjectRoot() . '/composer.json';

        if (!file_exists($composerFilePath)) {
            throw new \RuntimeException('Could not access composer file for project.');
        }

        $composerContents = json_decode(file_get_contents($composerFilePath), true);
        $fullNamespace = key($composerContents['autoload']['psr-4']);
        $projectName = trim(str_replace('Neighborhoods', '', $fullNamespace), '\\');

        return $projectName;
    }

    protected function fabricateSupportingActors() : GeneratorInterface
    {
        $this->getBradFabricator()
            ->setProjectName($this->getProjectName())
            ->setProjectRoot($this->getProjectRoot())
            ->fabricateSupportingActors();

        return $this;
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

    protected function getProjectRoot() : string
    {
        if ($this->projectRoot === null) {
            throw new \LogicException('Generator projectDir has not been set.');
        }
        return $this->projectRoot;
    }

    public function setProjectRoot(string $projectRoot) : GeneratorInterface
    {
        if ($this->projectRoot !== null) {
            throw new \LogicException('Generator projectDir is already set.');
        }
        $this->projectRoot = $projectRoot;
        return $this;
    }

    protected function hasBuildPlans() : bool
    {
        return $this->buildPlans !== null;
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

    protected function getWritePathForDao(SplFileInfo $dao) : string
    {
        $daoRelativePath = explode('/src/', $dao->getRealPath())[1];
        $daoRelativePath = str_replace('.prefab.definition.yml', '', $daoRelativePath) . '.fabrication.yml';

        $writeFilePath = __DIR__ . '/../bradfab/' . $daoRelativePath;
        return $writeFilePath;
    }

    protected function getWriteDirectoryForDao(string $writeFilePath) : string
    {
        $directoryPathArray = explode('/', $writeFilePath);
        unset($directoryPathArray[count($directoryPathArray) - 1]);
        $directoryPath = implode('/', $directoryPathArray);
        return $directoryPath;
    }


    public function setFileSystem(Filesystem $fileSystem) : GeneratorInterface
    {
        if ($this->fileSystem !== null) {
            throw new \LogicException('Generator fileSystem is already set.');
        }
        $this->fileSystem = $fileSystem;
        return $this;
    }

    protected function getBradFabricator() : BradFabricatorInterface
    {
        if ($this->bradFabricator === null) {
            throw new \LogicException('Generator bradFabricator has not been set.');
        }
        return $this->bradFabricator;
    }

    public function setBradFabricator(BradFabricatorInterface $bradFabricator) : GeneratorInterface
    {
        if ($this->bradFabricator !== null) {
            throw new \LogicException('Generator bradFabricator is already set.');
        }
        $this->bradFabricator = $bradFabricator;
        return $this;
    }

}

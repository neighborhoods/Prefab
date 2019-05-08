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

        echo ">> Bradfabbing supporting actors\n";
        $this->fabricateSupportingActors();

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
        if (!$buildConfiguration->hasSupportingActorGroup()) {
            $buildConfiguration->setSupportingActorGroup(BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COMPLETE);
        }

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
        $filesystem = $this->getFileSystem();
        $filesystem->mkdir([__DIR__ . '/../bradfab/', __DIR__ . '/../fabricatedFiles/']);

        // Where the Bradfab fabrication files were saved
        putenv('BRADFAB_TARGET_APPLICATION_SOURCE_PATH=' . realpath(__DIR__ . '/../bradfab'));
        // Where to put the supporting actors
        putenv('BRADFAB_TARGET_APPLICATION_FABRICATION_PATH=' . realpath(__DIR__ . '/../fabricatedFiles'));
        // Where to find the templates to generate the supporting actors
        putenv('BRADFAB_FABRICATOR_TEMPLATE_ACTOR_DIRECTORY_PATH='  . realpath(__DIR__ . '/Template/Prefab5/Actor'));
        // Namespace of the generated files
        putenv('BRADFAB_TARGET_APPLICATION_NAMESPACE=Neighborhoods\\'. $this->getProjectName() . '\\');

        $proteanContainerBuilder = (new Builder())->setApplicationRootDirectoryPath(realpath(__DIR__ . '/../../bradfab/'));

        $bradfab = (new Bradfab())->setProteanContainerBuilder($proteanContainerBuilder);
        $bradfab->run();

        $filesystem->mirror(realpath(__DIR__ . '/../fabricatedFiles'), realpath($this->getProjectRoot() . '/fab'));

        $filesystem->remove(realpath(__DIR__ . '/../fabricatedFiles/'));
//        $filesystem->remove(realpath(__DIR__ . '/../bradfab/'));
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

    public function getFileSystem() : Filesystem
    {
        if ($this->fileSystem === null) {
            $this->fileSystem = new Filesystem();
        }

        return $this->fileSystem;
    }

    public function setFileSystem(Filesystem $fileSystem) : GeneratorInterface
    {
        if ($this->fileSystem !== null) {
            throw new \LogicException('Generator fileSystem is already set.');
        }
        $this->fileSystem = $fileSystem;
        return $this;
    }
}

<?php


namespace Neighborhoods\Prefab;

use Neighborhoods\Prefab\HttpSkeleton;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Generator implements GeneratorInterface
{
    use HttpSkeleton\Generator\Factory\AwareTrait;
    use BuildConfiguration\Builder\Factory\AwareTrait;
    use FabricationSpecification\Builder\Factory\AwareTrait;
    use \Neighborhoods\Prefab\FabricationSpecification\Writer\Factory\AwareTrait;

    protected $httpSrcDir;
    protected $projectRoot;
    protected $srcLocation;
    protected $projectName;
    protected $fabricator;

    protected function configure()
    {
        $this->setHttpSrcDir(__DIR__ . '/../http');
        $this->setSrcLocation($this->getProjectRoot() . 'src/');

        return $this;
    }

    public function generate()
    {
        $this->configure();
        $this->setProjectName($this->getProjectNameFromComposer());

        echo PHP_EOL . ">> Copying HTTP machinery...";
        $this->generateHttpSkeleton();

        echo ">> Generating Prefab machinery...";
        $this->generatePrefabActors();

        echo PHP_EOL . "\e[0;32mPrefab complete.\e[0m" . PHP_EOL;

        return $this;
    }

    protected function writeFabricationSpecificationToDisk(BuildConfigurationInterface $configuration, SplFileInfo $dao) : GeneratorInterface
    {
        $fabricationSpecification = $this->getFabricationSpecificationForBuildConfiguration($configuration);
        $this->getFabricationSpecificationWriterFactory()->create()
            ->setFabricationSpecification($fabricationSpecification)
            ->setWritePath($this->getWritePathForDao($dao))
            ->write();

        return $this;
    }

    protected function getFabricationSpecificationForBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : FabricationSpecificationInterface
    {
         return $this->getFabricationSpecificationBuilderFactory()->create()
            ->setBuildConfiguration($buildConfiguration)
            ->build();
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
        $finder = new Finder();
        $daos = $finder->files()->name('*' . BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION)->in($this->srcLocation);

        if (count($daos) === 0) {
            echo "\e[1;33m skipped. \e[0m" . PHP_EOL;
            echo PHP_EOL . "\e[0;30;43mNo Prefab definition files found in " . $this->getSrcLocation() . "\e[0m" . PHP_EOL;
            echo "\e[1;33mNote:\e[0m Prefab definition files cannot be saved in the root of src/." .
                " They MUST be located in a versioned directory under src/" . PHP_EOL;

            return $this;
        }

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $configuration = $this->getBuildConfigurationBuilderFactory()->create()
                ->setYamlFilePath($dao->getRealPath())
                ->setProjectName($this->getProjectName())
                ->setProjectRoot($this->getProjectRoot())
                ->build();

            if ($configuration->hasHttpVerbs()) {
                $this->addHandlerToRouteFile($configuration);
            }

            $this->writeFabricationSpecificationToDisk($configuration, $dao);
        }

        $this->getFabricator()
            ->setProjectName($this->getProjectName())
            ->setProjectRoot($this->getProjectRoot())
            ->fabricateSupportingActors();

        echo "\e[0;32m success. \e[0m" . PHP_EOL;

        return $this;
    }

    // TODO: This was ported from the old version of Prefab as-is due to time constraints. This should be done more elegantly.
    protected function addHandlerToRouteFile(BuildConfigurationInterface $buildConfiguration) : GeneratorInterface
    {
        // Symfony Yaml doesn't support adding !php/const, so we have to create the string and append it to the end of the file
        $routePath = $buildConfiguration->getProjectDir() . 'fab/Prefab5/Zend/Expressive/Application/Decorator.service.yml';
        $file = file_get_contents($routePath);
        $routes = $this->formatRoutes($buildConfiguration);
        foreach ($routes as $route) {
            $file .= $route;
        }
        file_put_contents($routePath, $file);
        return $this;
    }

    protected function formatRoutes(BuildConfigurationInterface $buildConfiguration): array
    {
        $routes = [];
        $truncatedNamespace = explode('/fab/', $buildConfiguration->getRootSaveLocation())[1];
        $truncatedNamespace = str_replace(BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION, '', $truncatedNamespace);

        $fullDaoName = implode('', explode('/', $truncatedNamespace));

        foreach ($buildConfiguration->getHttpVerbs() as $httpVerb) {
            $verb = strtolower($httpVerb);
            $line =
                "    - [" . $verb .
                ", [!php/const \\" . $buildConfiguration->getActorNamespace() . '\\' . $buildConfiguration->getDaoName() .
                "\Map\Repository\HandlerInterface::ROUTE_PATH_" . strtoupper($fullDaoName) . "S," .
                "'@?" . $buildConfiguration->getActorNamespace() . '\\' . $buildConfiguration->getDaoName() . "\Map\Repository\HandlerInterface'," .
                "!php/const \\" . $buildConfiguration->getActorNamespace() . '\\' . $buildConfiguration->getDaoName() .
                "\Map\Repository\HandlerInterface::ROUTE_NAME_" . strtoupper($fullDaoName) . "S]]\n";
            $routes[] = $line;
        }
        return $routes;
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
        $daoRelativePath = str_replace(BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION, '', $daoRelativePath) . '.buphalo.v1.fabrication.yml';

        $writeFilePath = __DIR__ . '/../BuphaloFabFiles/' . $daoRelativePath;
        return $writeFilePath;
    }

    protected function getFabricator() : FabricatorInterface
    {
        if ($this->fabricator === null) {
            throw new \LogicException('Generator fabricator has not been set.');
        }
        return $this->fabricator;
    }

    public function setFabricator(FabricatorInterface $fabricator) : GeneratorInterface
    {
        if ($this->fabricator !== null) {
            throw new \LogicException('Generator fabricator is already set.');
        }
        $this->fabricator = $fabricator;
        return $this;
    }

}

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
    use FabricationSpecification\Writer\Factory\AwareTrait;
    use TokenReplacer\Factory\AwareTrait;

    protected $httpSrcDir;
    protected $projectRoot;
    protected $srcLocation;
    protected $vendorName;
    protected $projectName;
    protected $fabricator;
    protected $composerNamespace;

    protected const GREEN_TEXT_FORMAT_PATTERN = "\e[0;32m %S \e[0m";
    protected const YELLOW_HIGHLIGHT_FORMAT_PATTERN = "\e[0;30;43m%s\e[0m";

    protected const VENDOR_PLACEHOLDER = 'PREFAB_PLACEHOLDER_VENDOR';
    protected const PRODUCT_PLACEHOLDER = 'PREFAB_PLACEHOLDER_PRODUCT';

    public function generate()
    {
        $this->setHttpSrcDir(__DIR__ . '/../http');
        $this->setSrcLocation($this->getProjectRoot() . 'src/');
        $this->setProjectName($this->getProjectNameFromComposerFile());
        $this->setVendorName($this->getVendorNameFromComposerFile());

        echo PHP_EOL . ">> Copying HTTP machinery...";
        $this->generateHttpSkeleton();

        echo ">> Generating Prefab machinery...";
        $this->generatePrefabActors();

        echo PHP_EOL . sprintf(self::GREEN_TEXT_FORMAT_PATTERN, "Prefab complete.") . PHP_EOL;

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
        $generator->setVendorName($this->getVendorName())
            ->setProjectName($this->getProjectName())
            ->setSrcDirectory($this->getSrcLocation())
            ->setHttpSourceDirectory($this->getHttpSrcDir())
            ->setTargetDirectory($this->getProjectRoot())
            ->generate();

        echo sprintf(self::GREEN_TEXT_FORMAT_PATTERN, 'success.') . PHP_EOL;
        return $this;
    }

    protected function generatePrefabActors() : GeneratorInterface
    {
        $finder = new Finder();
        $daos = $finder->files()->name('*' . BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION)->in($this->srcLocation);

        if (count($daos) === 0) {
            echo sprintf(self::YELLOW_HIGHLIGHT_FORMAT_PATTERN, 'skipped.') . PHP_EOL;
            echo PHP_EOL . sprintf(self::YELLOW_HIGHLIGHT_FORMAT_PATTERN, "No Prefab definition files found in " . realpath($this->getSrcLocation())) . PHP_EOL;
            echo PHP_EOL . sprintf(self::YELLOW_HIGHLIGHT_FORMAT_PATTERN, 'Note:') . ' ';

            echo "Prefab definition files cannot be saved in the root of src/. " .
               "They MUST be located in a versioned directory under src/" . PHP_EOL;

            return $this;
        }

        /** @var SplFileInfo $dao */
        foreach ($daos as $dao) {
            $configuration = $this->getBuildConfigurationBuilderFactory()->create()
                ->setYamlFilePath($dao->getRealPath())
                ->setVendorName($this->getVendorName())
                ->setProjectName($this->getProjectName())
                ->setProjectRoot($this->getProjectRoot())
                ->build();

            if ($configuration->hasHttpVerbs()) {
                $this->addHandlerToRouteFile($configuration);
            }

            $this->writeFabricationSpecificationToDisk($configuration, $dao);
        }

        $this->getFabricator()
            ->setVendorName($this->getVendorName())
            ->setProjectName($this->getProjectName())
            ->setProjectRoot($this->getProjectRoot())
            ->fabricateSupportingActors();

        $this->getTokenReplacerFactory()->create()
            ->setReplacementDirectory($this->getProjectRoot() . '/fab')
            ->addNewTokenToReplace(self::PRODUCT_PLACEHOLDER, $this->getProjectName())
            ->addNewTokenToReplace(self::VENDOR_PLACEHOLDER, $this->getVendorName())
            ->replaceTokens();

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

    protected function getVendorNameFromComposerFile() : string
    {
        $namespaceArray = explode('\\', $this->getComposerNamespace());
        return $namespaceArray[0];
    }

    protected function getProjectNameFromComposerFile() : string
    {
        $namespaceArray = explode('\\', $this->getComposerNamespace());
        if (!isset($namespaceArray[1])) {
            throw new \RuntimeException('Unable to get project name from composer file');
        }

        return $namespaceArray[1];
    }

    protected function getComposerNamespace() : string
    {
        if ($this->composerNamespace === null) {
            $composerFilePath = $this->getProjectRoot() . '/composer.json';
            if (!file_exists($composerFilePath)) {
                throw new \RuntimeException('Could not access composer file for project.');
            }

            $composerContents = json_decode(file_get_contents($composerFilePath), true);
            $this->composerNamespace = key($composerContents['autoload']['psr-4']);
        }

        return $this->composerNamespace;
    }

    protected function getVendorName() : string
    {
        if ($this->vendorName === null) {
            throw new \LogicException('Generator vendorName has not been set.');
        }
        return $this->vendorName;
    }

    protected function setVendorName(string $vendorName) : GeneratorInterface
    {
        if ($this->vendorName !== null) {
            throw new \LogicException('Generator vendorName is already set.');
        }
        $this->vendorName = $vendorName;
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

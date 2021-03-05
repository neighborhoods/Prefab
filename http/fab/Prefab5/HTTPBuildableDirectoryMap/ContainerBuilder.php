<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use LogicException;
use Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler;
use Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder;
use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\Filesystem\Filesystem;
use Zend\Expressive\Application;

class ContainerBuilder implements ContainerBuilderInterface
{
    protected $buildableDirectoryMap;
    protected $directoryGroup;
    protected $rootDirectoryPath;

    public function build() : ContainerInterface
    {
        $filesystemProperties = new FilesystemProperties();
        $filesystemProperties->setRootDirectoryPath($this->getRootDirectoryPath());

        $directoryGroup = 'HTTP';
        $containerName = 'HTTP';
        if ($this->hasDirectoryGroup()) {
            $directoryGroup = $this->getDirectoryGroup();
            $containerName = 'HTTP_' . str_replace(['/', '-'], '_', $this->getDirectoryGroup());
        }

        $cacheHandler = (new SymfonyConfigCacheHandler\Builder())
            ->setName($containerName)
            ->setCacheDirPath($filesystemProperties->getCacheDirectoryPath())
            ->setDebug(false)
            ->build();

        if ($cacheHandler->hasInCache()) {
            return $cacheHandler->getFromCache();
        }

        $discoverableDirectoriesBuilder = (new DiscoverableDirectories\Builder())
            ->setDirectoryGroupName($directoryGroup);

        if ($this->hasBuildableDirectoryMap()) {
            $directoryGroupRoot = explode('/', $directoryGroup)[0];
            if (
                !isset($this->getBuildableDirectoryMap()[$directoryGroup])
                && !isset($this->getBuildableDirectoryMap()[$directoryGroupRoot])
            ) {
                throw (new InvalidDirectory\Exception)->setCode(InvalidDirectory\Exception::CODE_INVALID_DIRECTORY);
            }

            $routeBuildableDirectories =
                $this->getBuildableDirectoryMap()[$directoryGroup] ??
                $this->getBuildableDirectoryMap()[$directoryGroupRoot];

            $discoverableDirectoriesBuilder->setRecord($routeBuildableDirectories);
        }
        $discoverableDirectories = $discoverableDirectoriesBuilder->build();

        $containerBuilder = (new TinyContainerBuilder())
            ->setContainerBuilder(new SymfonyContainerBuilder())
            ->setRootPath($filesystemProperties->getRootDirectoryPath())
            ->setCacheHandler($cacheHandler)
            ->addCompilerPass(new AnalyzeServiceReferencesPass())
            ->addCompilerPass(new InlineServiceDefinitionsPass());

        $containerBuilder->addSourcePath($this->buildZendExpressive($filesystemProperties));
        $paths = $this->getFullPaths($discoverableDirectories, $filesystemProperties);
        foreach ($paths as $path) {
            $containerBuilder->addSourcePath($path);
        }
        return $containerBuilder->build();
    }

    public function buildZendExpressive(FilesystemPropertiesInterface $filesystemProperties): string
    {
        $servicesBuilder = new ZendExpressiveServicesBuilder();
        $servicesBuilder->setHTTPBuildableDirectoryMapFilesystemProperties($filesystemProperties);
        return $servicesBuilder->buildDIYAMLFile();
    }

    protected function getFullPaths(DiscoverableDirectoriesInterface $discoverableDirectories, FilesystemPropertiesInterface $filesystemProperties): array
    {
        $filesystem = new Filesystem();
        $fullPaths = [];
        foreach ($discoverableDirectories->getAppendedPaths() as $appendedPath) {
            $fullPaths[] = $filesystemProperties->getRootDirectoryPath() . '/' . $appendedPath;
        }
        if (empty($discoverableDirectories->getDirectoryPathFilters())) {
            $fullPaths[] = $filesystemProperties->getSourceDirectoryPath();
            if ($filesystem->exists($filesystemProperties->getFabricationDirectoryPath())) {
                $fullPaths[] = $filesystemProperties->getFabricationDirectoryPath();
            }
        } else {
            foreach ($discoverableDirectories->getDirectoryPathFilters() as $directoryPathFilter) {
                $fullPaths[] = $filesystemProperties->getSourceDirectoryPath() . '/' . $directoryPathFilter;
                $fabricationPathCandidate = $filesystemProperties->getFabricationDirectoryPath() . '/' . $directoryPathFilter;
                if ($filesystem->exists($fabricationPathCandidate)) {
                    $fullPaths[] = $fabricationPathCandidate;
                }
            }
        }
        foreach ($discoverableDirectories->getWelcomeBaskets() as $welcomeBasket) {
            $fullPaths[] = $filesystemProperties->getPrefab5DirectoryPath() . '/' . $welcomeBasket;
        }
        // Convert to unix style paths
        $fullPaths = array_map(static function (string $fullPath) {
            return str_replace('\\',  '/', $fullPath);
        }, $fullPaths);
        return $fullPaths;
    }

    public function setRootDirectoryPath(string $rootDirectoryPath): ContainerBuilderInterface
    {
        if (isset($this->rootDirectoryPath)) {
            throw new LogicException('Root Directory Path is already set.');
        }
        $this->rootDirectoryPath = $rootDirectoryPath;
        return $this;
    }

    protected function getBuildableDirectoryMap() : array
    {
        if ($this->buildableDirectoryMap === null) {
            throw new LogicException('ContainerBuilder buildableDirectoryMap has not been set.');
        }
        return $this->buildableDirectoryMap;
    }

    protected function hasBuildableDirectoryMap(): bool
    {
        return $this->buildableDirectoryMap !== null;
    }

    public function setBuildableDirectoryMap(array $buildableDirectoryMap) : ContainerBuilderInterface
    {
        if ($this->buildableDirectoryMap !== null) {
            throw new LogicException('ContainerBuilder buildableDirectoryMap is already set.');
        }
        $this->buildableDirectoryMap = $buildableDirectoryMap;
        return $this;
    }

    public function getDirectoryGroup() : string
    {
        if ($this->directoryGroup === null) {
            throw new LogicException('ContainerBuilder directoryGroup has not been set.');
        }
        return $this->directoryGroup;
    }

    public function setDirectoryGroup(string $directoryGroup) : ContainerBuilderInterface
    {
        if ($this->directoryGroup !== null) {
            throw new LogicException('ContainerBuilder directoryGroup is already set.');
        }
        $this->directoryGroup = $directoryGroup;
        return $this;
    }

    protected function hasDirectoryGroup(): bool
    {
        return $this->directoryGroup !== null;
    }

    private function getRootDirectoryPath(): string
    {
        if (!isset($this->rootDirectoryPath)) {
            throw new LogicException('Root Directory Path has not been set.');
        }
        return $this->rootDirectoryPath;
    }

}

<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container;

use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemPropertiesInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Builder implements BuilderInterface
{
    protected $service_ids_registered_for_public_access = [];
    protected $container_name;
    protected $filesystem_properties;
    protected $discoverable_directories;

    public function build(): ContainerInterface
    {
        $cacheHandler = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler\Builder())
            ->setName($this->getContainerName())
            ->setCacheDirPath($this->getFilesystemProperties()->getCacheDirectoryPath())
            ->setDebug(false)
            ->build();

        $containerBuilder = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder())
            ->setContainerBuilder(new \Symfony\Component\DependencyInjection\ContainerBuilder())
            ->setRootPath($this->getFilesystemProperties()->getRootDirectoryPath())
            ->setCacheHandler($cacheHandler)
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\AnalyzeServiceReferencesPass())
            ->addCompilerPass(new \Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass());

        $paths = $this->getFullPaths($this->getDiscoverableDirectories());
        foreach ($paths as $path) {
            $containerBuilder->addSourcePath($path);
        }
        foreach ($this->getServiceIdsRegisteredForPublicAccess() as $serviceId) {
            $containerBuilder->makePublic($serviceId);
        }
        return $containerBuilder->build();
    }

    public function getFilesystemProperties(): FilesystemPropertiesInterface
    {
        if ($this->filesystem_properties === null) {
            throw new \LogicException('Builder filesystem properties have not been set.');
        }

        return $this->filesystem_properties;
    }

    public function getContainerName(): string
    {
        if ($this->container_name === null) {
            throw new \LogicException('Builder container_name has not been set.');
        }

        return $this->container_name;
    }

    public function setContainerName(string $containerName): BuilderInterface
    {
        if ($this->container_name !== null) {
            throw new \LogicException('Builder container_name is already set.');
        }

        $this->container_name = $containerName;

        return $this;
    }

    public function getDiscoverableDirectories(): DiscoverableDirectoriesInterface
    {
        if ($this->discoverable_directories === null) {
            throw new \LogicException('Discoverable directories are not set.');
        }

        return $this->discoverable_directories;
    }

    public function setDiscoverableDirectories(DiscoverableDirectoriesInterface $discoverableDirectories): BuilderInterface
    {
        if (null !== $this->discoverable_directories) {
            throw new \LogicException('Discoverable directories are already set.');
        }

        $this->discoverable_directories = $discoverableDirectories;
        return $this;
    }

    protected function getFullPaths(DiscoverableDirectoriesInterface $discoverableDirectories): array
    {
        $filesystem = new Filesystem();
        $filesystemProperties = $this->getFilesystemProperties();
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
        $fullPaths = array_merge($fullPaths, $discoverableDirectories->getWelcomeBaskets()->getDirectoryPaths());
        return $fullPaths;
    }

    protected function getServiceIdsRegisteredForPublicAccess(): array
    {
        return $this->service_ids_registered_for_public_access;
    }

    public function registerServiceAsPublic(string $serviceId): BuilderInterface
    {
        if (isset($this->service_ids_registered_for_public_access[$serviceId])) {
            throw new \LogicException(
                sprintf('Service ID[%s] is already registered for public access.', $serviceId)
            );
        }
        $this->service_ids_registered_for_public_access[$serviceId] = $serviceId;

        return $this;
    }

    public function setFilesystemProperties(FilesystemPropertiesInterface $filesystemProperties): BuilderInterface
    {
        if (null !== $this->filesystem_properties) {
            throw new \LogicException('Filesystem properties are already set.');
        }

        $this->filesystem_properties = $filesystemProperties;
        return $this;
    }
}

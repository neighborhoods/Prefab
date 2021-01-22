<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container;

use Psr\Container\ContainerInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemProperties;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemPropertiesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Zend\Expressive\Application;

class Builder implements BuilderInterface
{
    protected $container;
    protected $symfony_container_builder;
    protected $service_ids_registered_for_public_access = [];
    protected $container_name;
    protected $filesystem_properties;
    protected $discoverable_directories;

    public function build(): ContainerInterface
    {
        $container = $this->getContainer();

        return $container;
    }

    protected function getContainer(): ContainerInterface
    {
        $cacheHandler = (new \Neighborhoods\DependencyInjectionContainerBuilderComponent\SymfonyConfigCacheHandler\Builder())
            ->setName($this->getContainerName())
            ->setCacheDirPath($this->getFilesystemProperties()->getCacheDirectoryPath())
            ->setDebug(false)
            ->build();

        if ($cacheHandler->hasInCache()) {
            return $cacheHandler->getFromCache();
        }

        $containerBuilder = $this->getSymfonyContainerBuilder();

        $cacheHandler->cache($containerBuilder);

        $this->container = $containerBuilder;

        return $this->container;
    }

    public function getFilesystemProperties(): FilesystemPropertiesInterface
    {
        if ($this->filesystem_properties === null) {
            $this->filesystem_properties = new FilesystemProperties();
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


    protected function buildContainerBuilder(): ContainerBuilder
    {
        $containerBuilder = $this->getSymfonyContainerBuilder();
        return $containerBuilder;
    }

    public function buildZendExpressive(): BuilderInterface
    {
        $currentWorkingDirectory = getcwd();
        chdir($this->getFilesystemProperties()->getRootDirectoryPath());
        /** @noinspection PhpIncludeInspection */
        $zendContainerBuilder = require $this->getFilesystemProperties()->getZendConfigContainerFilePath();
        $applicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        /** @noinspection PhpIncludeInspection */
        (require $this->getFilesystemProperties()->getPipelineFilePath())($applicationServiceDefinition);
        file_put_contents(
            $this->getFilesystemProperties()->getExpressiveDIYAMLFilePath(),
            (new YamlDumper($zendContainerBuilder))->dump()
        );
        chdir($currentWorkingDirectory);
        $this->getDiscoverableDirectories()->appendPath($this->getZendCacheDirectoryPath());

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

    protected function getZendCacheDirectoryPath(): string
    {
        return $this->getFilesystemProperties()->getZendCacheDirectoryPath();
    }

    protected function getSymfonyContainerBuilder(): ContainerBuilder
    {
        if ($this->symfony_container_builder === null) {
            $containerBuilder = new ContainerBuilder();
            $discoverableDirectoryFullPaths = $this->getFullPaths($this->getDiscoverableDirectories());
            $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
            $containerBuilderFacade->addFinder(
                (new Finder())->name('*.service.yml')->files()->in($discoverableDirectoryFullPaths)
            );
            $containerBuilderFacade->assembleYaml();
            $this->updateServiceDefinitions($containerBuilder);
            $containerBuilderFacade->build();
            $this->symfony_container_builder = $containerBuilder;
        }

        return $this->symfony_container_builder;
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

    protected function updateServiceDefinitions(ContainerBuilder $containerBuilder): BuilderInterface
    {
        $this->registerUserSpecifiedDefinitionsAsPublic($containerBuilder);

        return $this;
    }

    protected function registerUserSpecifiedDefinitionsAsPublic(ContainerBuilder $containerBuilder): void
    {
        foreach ($this->getServiceIdsRegisteredForPublicAccess() as $serviceId) {
            $containerBuilder->getDefinition($serviceId)->setPublic(true);
        }
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
}

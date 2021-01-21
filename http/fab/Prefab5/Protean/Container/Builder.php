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
    protected const SHOULD_REGISTER_ALL_SERVICES_AS_PUBLIC_DEFAULT = false;

    protected const INCORRECT_WRITE_LENGTH_EVENT_KEY = 'SymfonyContainerCacheWriteLengthMismatch';
    protected const TEMPORARY_CONTAINER_CACHE_FILE_NOT_RENAMED = 'TemporaryContainerCacheFileNotRenamed';
    protected const SUSPICOUS_CLASS_LENGTH_EVENT_KEY = 'SymfonyDumpSuspiciousClassLength';
    // A semi-arbitrary size in bytes that signals that the Symfony PHP dumper may have failed to convert the entire file to string
    protected const SUSPICIOUS_CLASS_LENGTH_SIZE_THRESHOLD = 300;

    protected $container;
    protected $symfony_container_builder;
    protected $service_ids_registered_for_public_access = [];
    protected $can_build_zend_expressive;
    protected $container_name;
    protected $filesystem_properties;
    protected $discoverable_directories;
    protected $shouldRegisterAllServicesAsPublic;

    public function build(): ContainerInterface
    {
        $container = $this->getContainer();

        return $container;
    }

    protected function getContainer(): ContainerInterface
    {
        if ($this->container === null) {
            $containerCacheFilePath = $this->getFilesystemProperties()->getSymfonyContainerFilePath();
            if (file_exists($containerCacheFilePath)) {
                require_once $containerCacheFilePath;
                $containerClass = sprintf('\\%s', $this->getContainerName());

                // TODO: PREF-146 - For some reason the class occasionally isn't found even when it exists
                // in the the cached file. For now, we just delete the file and recreate the container but
                // we should figure out why this is happening
                if (!class_exists($containerClass)) {
                    $this->deleteCachedContainer($containerCacheFilePath);
                    $containerBuilder = $this->buildContainerBuilder();
                } else {
                    $containerBuilder = new $containerClass;
                }

            } else {
                $containerBuilder = $this->buildContainerBuilder();
            }
            $this->container = $containerBuilder;
        }

        return $this->container;
    }

    public function getFilesystemProperties(): FilesystemPropertiesInterface
    {
        if ($this->filesystem_properties === null) {
            $this->filesystem_properties = new FilesystemProperties();
            $this->filesystem_properties->setProteanContainerBuilder($this);
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

    protected function deleteCachedContainer(string $containerCacheFilePath)
    {
        unlink($containerCacheFilePath);
        opcache_invalidate($containerCacheFilePath);
    }

    protected function buildContainerBuilder(): ContainerBuilder
    {
        if ($this->getCanBuildZendExpressive()) {
            $this->buildZendExpressive();
        }
        try {
            $this->cacheSymfonyContainerBuilder();
        } catch (\Throwable $throwable) {
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->setError($throwable);
            }
        }

        $containerBuilder = $this->getSymfonyContainerBuilder();
        return $containerBuilder;
    }

    protected function getCanBuildZendExpressive(): bool
    {
        return $this->can_build_zend_expressive === true;
    }

    /** @deprecated */
    public function setCanBuildZendExpressive(bool $can_build_zend_expressive): BuilderInterface
    {
        if ($this->can_build_zend_expressive !== null) {
            throw new \LogicException('Builder can_build_zend_expressive is already set.');
        }

        $this->can_build_zend_expressive = $can_build_zend_expressive;

        return $this;
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

    protected function cacheSymfonyContainerBuilder(): BuilderInterface
    {
        $containerBuilder = $this->getSymfonyContainerBuilder();
        $containerClass = (new PhpDumper($containerBuilder))->dump(['class' => $this->getContainerName()]);
        // A possible issue is that the process is dying during the write. So write to a temporary file, then
        // transactionally rename it
        $temporaryFilePath = $this->getFilesystemProperties()->getSymfonyContainerFilePath() . '-temp';
        if (file_exists($temporaryFilePath)) {
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->log(
                    [
                        'message' => sprintf('message: %s. filepath: %s. class: %s.',
                            self::TEMPORARY_CONTAINER_CACHE_FILE_NOT_RENAMED,
                            $temporaryFilePath,
                            $containerClass)
                    ]);
            }

        }

        $writtenBytes = file_put_contents(
            $temporaryFilePath,
            $containerClass,
            LOCK_EX
        );

        // This signals a failure of file_put_contents to write the entirety of the file to disk
        if (strlen($containerClass) !== $writtenBytes) {
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->log(
                    [
                        'message' => sprintf('message: %s. bytes_written_to_disk: %s. class_size: %s. class: %s.',
                            self::INCORRECT_WRITE_LENGTH_EVENT_KEY,
                            $writtenBytes,
                            strlen($containerClass),
                            $containerClass)
                    ]);
            }

            $this->deleteCachedContainer($temporaryFilePath);

        } else if (strlen($containerClass) < self::SUSPICIOUS_CLASS_LENGTH_SIZE_THRESHOLD) {
            // This signals that Symfony PHPDumper may have failed to convert the entire container class to a string when dumping
            $repository = new \Neighborhoods\DatadogComponent\GlobalTracer\Repository();
            $tracer = $repository->get();
            $span = $tracer->getActiveSpan();
            if ($span !== null) {
                $span->log(
                    [
                        'message' => sprintf('message: %s. bytes_written_to_disk: %s. class_size: %s. class: %s.',
                            self::SUSPICOUS_CLASS_LENGTH_EVENT_KEY,
                            $writtenBytes,
                            strlen($containerClass),
                            $containerClass)
                    ]);
            }
        }

        rename($temporaryFilePath, $this->getFilesystemProperties()->getSymfonyContainerFilePath());
        return $this;
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
        if ($this->getShouldRegisterAllServicesAsPublic()) {
            $this->registerAllDefinitionsAsPublic($containerBuilder);
            $this->registerAllAliasesAsPublic($containerBuilder);
        } else {
            $this->registerUserSpecifiedDefinitionsAsPublic($containerBuilder);
        }

        return $this;
    }

    public function getShouldRegisterAllServicesAsPublic(): bool
    {
        if (null === $this->shouldRegisterAllServicesAsPublic) {
            $this->shouldRegisterAllServicesAsPublic =
                static::SHOULD_REGISTER_ALL_SERVICES_AS_PUBLIC_DEFAULT;
        }

        return $this->shouldRegisterAllServicesAsPublic;
    }

    public function setShouldRegisterAllServicesAsPublic(bool $shouldRegisterAllServicesAsPublic): BuilderInterface
    {
        if (null !== $this->shouldRegisterAllServicesAsPublic) {
            throw new \LogicException('Builder shouldRegisterAllServicesAsPublic is already set.');
        }

        $this->shouldRegisterAllServicesAsPublic = $shouldRegisterAllServicesAsPublic;

        return $this;
    }

    protected function registerAllDefinitionsAsPublic(ContainerBuilder $containerBuilder): void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            $definition->setPublic(true);
        }
    }

    protected function registerAllAliasesAsPublic(ContainerBuilder $containerBuilder): void
    {
        foreach ($containerBuilder->getAliases() as $alias) {
            $alias->setPublic(true);
        }
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

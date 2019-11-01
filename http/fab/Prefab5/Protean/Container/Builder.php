<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\DiscoverableDirectories;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\DiscoverableDirectoriesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemProperties;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemPropertiesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
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

    public function build() : ContainerInterface
    {
        $container = $this->getContainer();

        return $container;
    }

    protected function getContainer() : ContainerInterface
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

    protected function deleteCachedContainer(string $containerCacheFilePath)
    {
        unlink($containerCacheFilePath);
        opcache_invalidate($containerCacheFilePath);
    }

    protected function buildContainerBuilder() : ContainerBuilder
    {
        if ($this->getCanBuildZendExpressive()) {
            $this->buildZendExpressive();
        }
        try {
            $this->cacheSymfonyContainerBuilder();
        } catch (\Throwable $throwable) {
            (new NewRelic())->noticeThrowable($throwable);
        }
        
        $containerBuilder = $this->getSymfonyContainerBuilder();
        return $containerBuilder;
    }

    /** @deprecated */
    public function setCanBuildZendExpressive(bool $can_build_zend_expressive) : BuilderInterface
    {
        if ($this->can_build_zend_expressive !== null) {
            throw new \LogicException('Builder can_build_zend_expressive is already set.');
        }

        $this->can_build_zend_expressive = $can_build_zend_expressive;

        return $this;
    }

    protected function getCanBuildZendExpressive() : bool
    {
        return $this->can_build_zend_expressive === true;
    }

    protected function getSymfonyContainerBuilder() : ContainerBuilder
    {
        if ($this->symfony_container_builder === null) {
            $containerBuilder = new ContainerBuilder();
            $discoverableDirectoryFullPaths = $this->getDiscoverableDirectories()->getFullPaths();
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

    protected function cacheSymfonyContainerBuilder() : BuilderInterface
    {
        $containerBuilder = $this->getSymfonyContainerBuilder();
        $containerClass = (new PhpDumper($containerBuilder))->dump(['class' => $this->getContainerName()]);
        // A possible issue is that the process is dying during the write. So write to a temporary file, then
        // transactionally rename it
        $temporaryFilePath = $this->getFilesystemProperties()->getSymfonyContainerFilePath() . '-temp';
        if (file_exists($temporaryFilePath)) {
            (new NewRelic())->recordCustomEvent(
                self::TEMPORARY_CONTAINER_CACHE_FILE_NOT_RENAMED,
                [
                    'filepath' => $temporaryFilePath,
                    'class' => $containerClass
                ]
            );
        }

        $writtenBytes = file_put_contents(
            $temporaryFilePath,
            $containerClass,
            LOCK_EX
        );

        // This signals a failure of file_put_contents to write the entirety of the file to disk
        if (strlen($containerClass) !== $writtenBytes) {
            (new NewRelic())->recordCustomEvent(
                self::INCORRECT_WRITE_LENGTH_EVENT_KEY,
                [
                    'bytes_written_to_disk' => $writtenBytes,
                    'class_size' => strlen($containerClass),
                    'class' => $containerClass
                ]
            );

            $this->deleteCachedContainer($temporaryFilePath);

        } else if (strlen($containerClass) < self::SUSPICIOUS_CLASS_LENGTH_SIZE_THRESHOLD) {
            // This signals that Symfony PHPDumper may have failed to convert the entire container class to a string when dumping
            (new NewRelic())->recordCustomEvent(
                self::SUSPICOUS_CLASS_LENGTH_EVENT_KEY,
                [
                    'bytes_written_to_disk' => $writtenBytes,
                    'class_size' => strlen($containerClass),
                    'class' => $containerClass
                ]
            );
        }

        rename($temporaryFilePath, $this->getFilesystemProperties()->getSymfonyContainerFilePath());
        return $this;
    }

    public function buildZendExpressive() : BuilderInterface
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

    public function registerServiceAsPublic(string $serviceId) : BuilderInterface
    {
        if (isset($this->service_ids_registered_for_public_access[$serviceId])) {
            throw new \LogicException(
                sprintf('Service ID[%s] is already registered for public access.', $serviceId)
            );
        }
        $this->service_ids_registered_for_public_access[$serviceId] = $serviceId;

        return $this;
    }

    protected function getServiceIdsRegisteredForPublicAccess() : array
    {
        return $this->service_ids_registered_for_public_access;
    }

    protected function updateServiceDefinitions(
        ContainerBuilder $containerBuilder
    ) : BuilderInterface
    {
        if ($this->getShouldRegisterAllServicesAsPublic()) {
            $this->registerAllDefinitionsAsPublic($containerBuilder);
            $this->registerAllAliasesAsPublic($containerBuilder);
        } else {
            $this->registerUserSpecifiedDefinitionsAsPublic($containerBuilder);
        }

        return $this;
    }

    protected function registerAllDefinitionsAsPublic(
        ContainerBuilder $containerBuilder
    ) : void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            $definition->setPublic(true);
        }
    }

    protected function registerAllAliasesAsPublic(
        ContainerBuilder $containerBuilder
    ) : void
    {
        foreach ($containerBuilder->getAliases() as $alias) {
            $alias->setPublic(true);
        }
    }

    protected function registerUserSpecifiedDefinitionsAsPublic(
        ContainerBuilder $containerBuilder
    ) : void
    {
        foreach ($this->getServiceIdsRegisteredForPublicAccess() as $serviceId) {
            $containerBuilder->getDefinition($serviceId)->setPublic(true);
        }
    }

    public function getContainerName() : string
    {
        if ($this->container_name === null) {
            throw new \LogicException('Builder container_name has not been set.');
        }

        return $this->container_name;
    }

    public function setContainerName(string $containerName) : BuilderInterface
    {
        if ($this->container_name !== null) {
            throw new \LogicException('Builder container_name is already set.');
        }

        $this->container_name = $containerName;

        return $this;
    }

    public function setShouldRegisterAllServicesAsPublic(
        bool $shouldRegisterAllServicesAsPublic
    ) : BuilderInterface
    {
        if (null !== $this->shouldRegisterAllServicesAsPublic) {
            throw new \LogicException('Builder shouldRegisterAllServicesAsPublic is already set.');
        }

        $this->shouldRegisterAllServicesAsPublic = $shouldRegisterAllServicesAsPublic;

        return $this;
    }

    public function getShouldRegisterAllServicesAsPublic() : bool
    {
        if (null === $this->shouldRegisterAllServicesAsPublic) {
            $this->shouldRegisterAllServicesAsPublic =
                static::SHOULD_REGISTER_ALL_SERVICES_AS_PUBLIC_DEFAULT;
        }

        return $this->shouldRegisterAllServicesAsPublic;
    }

    public function getFilesystemProperties() : FilesystemPropertiesInterface
    {
        if ($this->filesystem_properties === null) {
            $this->filesystem_properties = new FilesystemProperties();
            $this->filesystem_properties->setProteanContainerBuilder($this);
        }

        return $this->filesystem_properties;
    }

    public function getDiscoverableDirectories() : DiscoverableDirectoriesInterface
    {
        if ($this->discoverable_directories === null) {
            $discoverableDirectories = new DiscoverableDirectories();
            $discoverableDirectories->setProteanContainerBuilderFilesystemProperties($this->getFilesystemProperties());
            $this->discoverable_directories = $discoverableDirectories;
        }

        return $this->discoverable_directories;
    }

    protected function getZendCacheDirectoryPath() : string
    {
        return $this->getFilesystemProperties()->getZendCacheDirectoryPath();
    }
}

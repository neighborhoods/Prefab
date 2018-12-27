<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder\FilesystemProperties;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder\FilesystemPropertiesInterface;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Symfony\Component\Finder\Finder;
use Zend\Expressive\Application;

class Builder implements BuilderInterface
{
    protected $container;
    protected $symfony_container_builder;
    protected $service_ids_registered_for_public_access = [];
    protected $can_build_zend_expressive;
    protected $container_name;
    protected $filesystem_properties;

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
                $containerBuilder = new $containerClass;
            } else {
                if ($this->getCanBuildZendExpressive()) {
                    $this->buildZendExpressive();
                }
                $this->cacheSymfonyContainerBuilder();
                $containerBuilder = $this->getSymfonyContainerBuilder();
            }
            $this->container = $containerBuilder;
        }

        return $this->container;
    }

    public function setCanBuildZendExpressive(bool $canBuildZendExpressive): BuilderInterface
    {
        if ($this->can_build_zend_expressive === null) {
            $this->can_build_zend_expressive = $canBuildZendExpressive;
        } else {
            throw new \LogicException('Builder can_build_zend_expressive is already set.');
        }

        return $this;
    }

    protected function getCanBuildZendExpressive(): bool
    {
        if ($this->can_build_zend_expressive === null) {
            throw new \LogicException('Builder can_build_zend_expressive is not set.');
        }

        return $this->can_build_zend_expressive;
    }

    protected function getSymfonyContainerBuilder(): ContainerBuilder
    {
        if ($this->symfony_container_builder === null) {
            $containerBuilder = new ContainerBuilder();
            $discoverableDirectories = $this->getFilesystemProperties()->getDiscoverableDirectories();
            $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
            $containerBuilderFacade->addFinder(
                (new Finder())->name('*.service.yml')->files()->in($discoverableDirectories)
            );
            $containerBuilderFacade->assembleYaml();
            $this->updateServiceDefinitions($containerBuilder);
            $containerBuilderFacade->build();
            $this->symfony_container_builder = $containerBuilder;
        }

        return $this->symfony_container_builder;
    }

    protected function cacheSymfonyContainerBuilder(): BuilderInterface
    {
        $containerBuilder = $this->getSymfonyContainerBuilder();
        file_put_contents(
            $this->getFilesystemProperties()->getSymfonyContainerFilePath(),
            (new PhpDumper($containerBuilder))->dump(['class' => $this->getContainerName()])
        );

        return $this;
    }

    protected function buildZendExpressive(): BuilderInterface
    {
        $currentWorkingDirectory = getcwd();
        chdir($this->getFilesystemProperties()->getRootDirectoryPath());
        $zendContainerBuilder = require $this->getFilesystemProperties()->getZendConfigContainerFilePath();
        $applicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        (require_once $this->getFilesystemProperties()->getPipelineFilePath())($applicationServiceDefinition);
        file_put_contents(
            $this->getFilesystemProperties()->getExpressiveDIYAMLFilePath(),
            (new YamlDumper($zendContainerBuilder))->dump()
        );
        chdir($currentWorkingDirectory);

        return $this;
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

    protected function getServiceIdsRegisteredForPublicAccess(): array
    {
        return $this->service_ids_registered_for_public_access;
    }

    protected function updateServiceDefinitions(ContainerBuilder $containerBuilder): BuilderInterface
    {
        foreach ($this->getServiceIdsRegisteredForPublicAccess() as $serviceId) {
            $containerBuilder->getDefinition($serviceId)->setPublic(true);
        }

        return $this;
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

    public function getFilesystemProperties(): FilesystemPropertiesInterface
    {
        if ($this->filesystem_properties === null) {
            $this->filesystem_properties = new FilesystemProperties();
            $this->filesystem_properties->setProteanContainerBuilder($this);
        }

        return $this->filesystem_properties;
    }
}

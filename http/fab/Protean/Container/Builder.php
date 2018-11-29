<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Protean\Container;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Dumper\YamlDumper;
use Symfony\Component\Finder\Finder;
use Zend\Expressive\Application;

class Builder implements BuilderInterface
{
    protected $container;
    protected $applicationRootDirectoryPath;
    protected $symfonyContainerBuilder;
    protected $serviceIdsRegisteredForPublicAccess = [];

    public function build(): ContainerInterface
    {
        $container = $this->getContainer();

        return $container;
    }

    protected function getContainer(): ContainerInterface
    {
        if ($this->container === null) {
            $containerCacheFilePath = $this->getSymfonyContainerFilePath();
            if (file_exists($containerCacheFilePath)) {
                require_once $containerCacheFilePath;
                $containerBuilder = new \ProjectServiceContainer();
            } else {
                $this->buildZendExpressive();
                $this->cacheSymfonyContainerBuilder();
                $containerBuilder = $this->getSymfonyContainerBuilder();
            }
            $this->container = $containerBuilder;
        }

        return $this->container;
    }

    protected function getSymfonyContainerBuilder(): ContainerBuilder
    {
        if ($this->symfonyContainerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $discoverableDirectories[] = $this->getCacheDirectoryPath();
            $discoverableDirectories[] = $this->getFabricationDirectoryPath();
            $discoverableDirectories[] = $this->getSourceDirectoryPath();
            $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
            $containerBuilderFacade->addFinder(
                (new Finder())->name('*.yml')->notName('*.prefab.definition.yml')->files()->in($discoverableDirectories)
            );
            $containerBuilderFacade->assembleYaml();
            $this->updateServiceDefinitions($containerBuilder);
            $containerBuilderFacade->build();
            $this->symfonyContainerBuilder = $containerBuilder;
        }

        return $this->symfonyContainerBuilder;
    }

    protected function cacheSymfonyContainerBuilder(): BuilderInterface
    {
        $containerBuilder = $this->getSymfonyContainerBuilder();
        file_put_contents($this->getSymfonyContainerFilePath(), (new PhpDumper($containerBuilder))->dump());

        return $this;
    }

    protected function buildZendExpressive(): BuilderInterface
    {
        $currentWorkingDirectory = getcwd();
        chdir($this->getApplicationRootDirectoryPath());
        $zendContainerBuilder = require $this->getZendConfigContainerFilePath();
        $ApplicationServiceDefinition = $zendContainerBuilder->findDefinition(Application::class);
        (require_once $this->getPipelineFilePath())($ApplicationServiceDefinition);
        file_put_contents($this->getExpressiveDIYAMLFilePath(), (new YamlDumper($zendContainerBuilder))->dump());
        chdir($currentWorkingDirectory);

        return $this;
    }

    protected function getFabricationDirectoryPath(): string
    {
        return realpath($this->getApplicationRootDirectoryPath() . '/fab');
    }

    protected function getSourceDirectoryPath(): string
    {
        return realpath($this->getApplicationRootDirectoryPath() . '/src');
    }

    protected function getCacheDirectoryPath(): string
    {
        return realpath($this->getApplicationRootDirectoryPath() . '/data/cache');
    }

    protected function getPipelineFilePath(): string
    {
        return $this->getApplicationRootDirectoryPath() . '/config/pipeline.php';
    }

    protected function getZendConfigContainerFilePath(): string
    {
        return $this->getApplicationRootDirectoryPath() . '/config/container.php';
    }

    protected function getExpressiveDIYAMLFilePath(): string
    {
        return $this->getApplicationRootDirectoryPath() . '/data/cache/expressive.yml';
    }

    protected function getSymfonyContainerFilePath(): string
    {
        return $this->getApplicationRootDirectoryPath() . '/data/cache/container.php';
    }

    public function setApplicationRootDirectoryPath(string $applicationRootDirectoryPath)
    {
        if ($this->applicationRootDirectoryPath === null) {
            $applicationRootDirectoryPath = realpath(rtrim($applicationRootDirectoryPath, "/"));
            if (is_dir($applicationRootDirectoryPath)) {
                $this->applicationRootDirectoryPath = $applicationRootDirectoryPath;
            } else {
                $message = sprintf(
                    'Application root directory path[%s] is not a directory.',
                    $applicationRootDirectoryPath
                );
                throw new \UnexpectedValueException($message);
            }
        } else {
            throw new \LogicException('Application root directory path is already set.');
        }

        return $this;
    }

    protected function getApplicationRootDirectoryPath(): string
    {
        if ($this->applicationRootDirectoryPath === null) {
            throw new \LogicException('Application root directory path is not set.');
        }

        return $this->applicationRootDirectoryPath;
    }

    public function registerServiceAsPublic(string $serviceId): BuilderInterface
    {
        if (isset($this->serviceIdsRegisteredForPublicAccess[$serviceId])) {
            throw new \LogicException(
                sprintf('Service ID[%s] is already registered for public access.', $serviceId)
            );
        }
        $this->serviceIdsRegisteredForPublicAccess[$serviceId] = $serviceId;

        return $this;
    }

    protected function getServiceIdsRegisteredForPublicAccess(): array
    {
        return $this->serviceIdsRegisteredForPublicAccess;
    }

    protected function updateServiceDefinitions(ContainerBuilder $containerBuilder): BuilderInterface
    {
        foreach ($this->getServiceIdsRegisteredForPublicAccess() as $publicDefinitionId) {
            $containerBuilder->getDefinition($publicDefinitionId)->setPublic(true);
        }

        return $this;
    }
}

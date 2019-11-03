<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Protean\Container;

use Neighborhoods\Prefab\Symfony\Component\DependencyInjection\ContainerBuilder\Facade;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

class Builder implements BuilderInterface
{
    protected $container;
    protected $applicationRootDirectoryPath;
    protected $symfonyContainerBuilder;

    public function build(): ContainerInterface
    {
        $container = $this->getContainer();

        return $container;
    }

    protected function getContainer(): ContainerInterface
    {
        if ($this->container === null) {
            $containerBuilder = $this->getSymfonyContainerBuilder();
            $this->container = $containerBuilder;
        }

        return $this->container;
    }

    protected function getSymfonyContainerBuilder(): ContainerBuilder
    {
        if ($this->symfonyContainerBuilder === null) {
            $containerBuilder = new ContainerBuilder();
            $discoverableDirectories[] = $this->getFabricationDirectoryPath();
            $discoverableDirectories[] = $this->getSourceDirectoryPath();
            $containerBuilderFacade = (new Facade())->setContainerBuilder($containerBuilder);
            $containerBuilderFacade->addFinder(
                (new Finder())->name('*.service.yml')->files()
                    ->in($discoverableDirectories)
                    ->exclude('Template/Prefab5/')
                    ->exclude('BuphaloTemplates/')
            );
            $containerBuilderFacade->assembleYaml();
            $containerBuilderFacade->build();
            $this->symfonyContainerBuilder = $containerBuilder;
        }

        return $this->symfonyContainerBuilder;
    }

    protected function getFabricationDirectoryPath(): string
    {
        return realpath($this->getApplicationRootDirectoryPath() . '/fab');
    }

    protected function getSourceDirectoryPath(): string
    {
        return realpath($this->getApplicationRootDirectoryPath() . '/src');
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
}

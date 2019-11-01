<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\HTTPBuildableDirectoryMap\InvalidDirectory;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTP;

class ContainerBuilder implements ContainerBuilderInterface
{
    use Protean\Container\Builder\AwareTrait;

    protected const YAML_KEY_BUILDABLE_DIRECTORIES = 'buildable_directories';
    protected const YAML_KEY_WELCOME_BASKETS = 'welcome_baskets';
    protected const YAML_KEY_APPENDED_PATHS = 'appended_paths';

    protected $buildableDirectoryMap;
    protected $directoryGroup;

    public function getContainerBuilder() : Protean\Container\BuilderInterface
    {
        $this->getProteanContainerBuilder()->setContainerName(
            'HTTP_' . str_replace('/', '_', $this->getDirectoryGroup())
        );

        $directoryGroupRoot = explode('/', $this->getDirectoryGroup())[0];

        if (
            !isset($this->getBuildableDirectoryMap()[$this->getDirectoryGroup()])
            && !isset($this->getBuildableDirectoryMap()[$directoryGroupRoot])
        ) {
            throw (new InvalidDirectory\Exception)->setCode(InvalidDirectory\Exception::CODE_INVALID_DIRECTORY);
        }

        $this->getProteanContainerBuilder()->buildZendExpressive();

        $routeBuildableDirectories =
            $this->getBuildableDirectoryMap()[$this->getDirectoryGroup()] ??
            $this->getBuildableDirectoryMap()[$directoryGroupRoot];

        $this->addBuildableDirectories($routeBuildableDirectories);
        $this->addWelcomeBaskets($routeBuildableDirectories);
        $this->addAppendedPaths($routeBuildableDirectories);

        return $this->getProteanContainerBuilder();
    }

    protected function addBuildableDirectories(array $httpBuildableDirectoryMap) : ContainerBuilderInterface
    {
        if (isset($httpBuildableDirectoryMap[self::YAML_KEY_BUILDABLE_DIRECTORIES])) {
            foreach ($httpBuildableDirectoryMap[self::YAML_KEY_BUILDABLE_DIRECTORIES] as $directory) {
                $this->getProteanContainerBuilder()
                    ->getDiscoverableDirectories()
                    ->addDirectoryPathFilter($directory);
            }
        }

        return $this;
    }

    protected function addWelcomeBaskets(array $httpBuildableDirectoryMap) : ContainerBuilderInterface
    {
        if (isset($httpBuildableDirectoryMap[self::YAML_KEY_WELCOME_BASKETS])) {
            foreach ($httpBuildableDirectoryMap[self::YAML_KEY_WELCOME_BASKETS] as $welcomeBasket) {
                $this->getProteanContainerBuilder()
                    ->getDiscoverableDirectories()
                    ->getWelcomeBaskets()
                    ->addWelcomeBasket($welcomeBasket);
            }
        }

        return $this;
    }

    protected function addAppendedPaths(array $httpBuildableDirectoryMap) : ContainerBuilderInterface
    {
        if (isset($httpBuildableDirectoryMap[self::YAML_KEY_APPENDED_PATHS])) {
            foreach ($httpBuildableDirectoryMap[self::YAML_KEY_APPENDED_PATHS] as $path) {
                $this->getProteanContainerBuilder()
                    ->getDiscoverableDirectories()
                    ->appendPath(
                        $this->getProteanContainerBuilder()->getFilesystemProperties()->getRootDirectoryPath() . '/' . $path
                    );
            }
        }

        return $this;
    }


    protected function getRoute() : string
    {
        if ($this->route === null) {
            throw new \LogicException('ContainerBuilder route has not been set.');
        }
        return $this->route;
    }

    public function setRoute(string $route) : ContainerBuilderInterface
    {
        if ($this->route !== null) {
            throw new \LogicException('ContainerBuilder route is already set.');
        }
        $this->route = $route;
        return $this;
    }

    protected function getBuildableDirectoryMap() : array
    {
        if ($this->buildableDirectoryMap === null) {
            throw new \LogicException('ContainerBuilder buildableDirectoryMap has not been set.');
        }
        return $this->buildableDirectoryMap;
    }

    public function setBuildableDirectoryMap(array $buildableDirectoryMap) : ContainerBuilderInterface
    {
        if ($this->buildableDirectoryMap !== null) {
            throw new \LogicException('ContainerBuilder buildableDirectoryMap is already set.');
        }
        $this->buildableDirectoryMap = $buildableDirectoryMap;
        return $this;
    }

    public function getDirectoryGroup() : string
    {
        if ($this->directoryGroup === null) {
            throw new \LogicException('ContainerBuilder directoryGroup has not been set.');
        }
        return $this->directoryGroup;
    }

    public function setDirectoryGroup(string $directoryGroup) : ContainerBuilderInterface
    {
        if ($this->directoryGroup !== null) {
            throw new \LogicException('ContainerBuilder directoryGroup is already set.');
        }
        $this->directoryGroup = $directoryGroup;
        return $this;
    }

}

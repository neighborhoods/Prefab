<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

class DiscoverableDirectories implements DiscoverableDirectoriesInterface
{
    protected $directoryPaths = [];
    protected $appendedPaths = [];
    protected $welcomeBaskets = [];
    protected $directoryGroupName;

    public function setDirectoryGroupName(string $directoryGroupName): DiscoverableDirectoriesInterface
    {
        if (isset($this->directoryGroupName)) {
            throw new \LogicException('Directory Group Name is already set.');
        }
        $this->directoryGroupName = $directoryGroupName;
        return $this;
    }

    public function addDirectoryPathFilter(string $directoryPathFilter) : DiscoverableDirectoriesInterface
    {
        $directoryPathFilter = (substr($directoryPathFilter, -1) === '/')
            ? $directoryPathFilter
            : $directoryPathFilter . '/';

        if (isset($this->directoryPaths[$directoryPathFilter])) {
            throw new \LogicException(
                sprintf('DiscoverableDirectories directoryPaths[%s] is already set.', $directoryPathFilter)
            );
        }

        $this->directoryPaths[$directoryPathFilter] = $directoryPathFilter;

        return $this;
    }

    public function getDirectoryPathFilters(): array
    {
        return $this->directoryPaths;
    }

    public function appendPath(string $path) : DiscoverableDirectoriesInterface
    {
        if (isset($this->appendedPaths[$path])) {
            throw new \LogicException(
                sprintf('DiscoverableDirectories appendedPaths[%s] is already set.', $path)
            );
        }

        $this->appendedPaths[$path] = $path;

        return $this;
    }

    public function getAppendedPaths(): array
    {
        return $this->appendedPaths;
    }

    public function getDirectoryGroupName(): string
    {
        if (!isset($this->directoryGroupName)) {
            throw new \LogicException('Directory Group Name has not been set.');
        }
        return $this->directoryGroupName;
    }

    public function getWelcomeBaskets(): array
    {
        return $this->welcomeBaskets;
    }

    public function addWelcomeBasket(string $welcomeBasket): DiscoverableDirectoriesInterface
    {
        if (isset($this->welcomeBaskets[$welcomeBasket])) {
            throw new \LogicException(
                sprintf('DiscoverableDirectories welcomeBaskets[%s] is already set.', $welcomeBasket)
            );
        }

        $this->welcomeBaskets[$welcomeBasket] = $welcomeBasket;

        return $this;
    }
}

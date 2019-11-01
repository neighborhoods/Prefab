<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;
use Symfony\Component\Filesystem\Filesystem;

class DiscoverableDirectories implements DiscoverableDirectoriesInterface
{
    use Prefab5\Protean\Container\Builder\FilesystemProperties\AwareTrait;

    protected $directory_filters = [];
    protected $full_paths = [];
    protected $appended_paths = [];
    protected $filesystem;
    protected $welcome_baskets;

    public function getFullPaths() : array
    {
        if (empty($this->full_paths)) {
            $this->addFabricationDirectoryPaths();
            $this->addSourceDirectoryPaths();
            $this->addWelcomeBaskets();
            $this->addAppendedPaths();
        }

        return $this->full_paths;
    }

    protected function hasFilters() : bool
    {
        return !empty($this->directory_filters);
    }

    protected function getFilters() : array
    {
        return $this->directory_filters;
    }

    public function addDirectoryPathFilter(string $directoryPathFilter) : DiscoverableDirectoriesInterface
    {
        $directoryPathFilter = (substr($directoryPathFilter, -1) === '/')
            ? $directoryPathFilter
            : $directoryPathFilter . '/';

        if (isset($this->directory_filters[$directoryPathFilter])) {
            throw new \LogicException(
                sprintf('FilesystemProperties directory_filter[%s] is already set.', $directoryPathFilter)
            );
        }
        foreach ($this->directory_filters as $existingDirectoryFilter) {
            if (strpos($existingDirectoryFilter, $directoryPathFilter) === 0
                || strpos($directoryPathFilter, $existingDirectoryFilter) === 0) {
                throw new \LogicException(
                    sprintf(
                        'FilesystemProperties directory_filter[%s] is a parent node of [%s].',
                        $existingDirectoryFilter,
                        $directoryPathFilter
                    )
                );
            }
        }

        $this->directory_filters[$directoryPathFilter] = $directoryPathFilter;

        return $this;
    }

    public function addAppendedPaths() : array
    {
        foreach ($this->appended_paths as $appendedPath) {
            $this->addFullPath($appendedPath);
        }

        return $this->appended_paths;
    }

    public function appendPath(string $path) : DiscoverableDirectoriesInterface
    {
        if (isset($this->appended_paths[$path])) {
            throw new \LogicException(
                sprintf('DiscoverableDirectories appended_paths[%s] is already set.', $path)
            );
        }

        $this->appended_paths[$path] = $path;

        return $this;
    }

    protected function getCacheDirectoryPath() : string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getCacheDirectoryPath();
    }

    protected function getFabricationDirectoryPath() : string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getFabricationDirectoryPath();
    }

    protected function getSourceDirectoryPath() : string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getSourceDirectoryPath();
    }

    protected function getFilesystem() : Filesystem
    {
        if ($this->filesystem === null) {
            $this->filesystem = new Filesystem();
        }

        return $this->filesystem;
    }

    protected function addFabricationDirectoryPaths() : DiscoverableDirectoriesInterface
    {
        if (!empty($this->getFilters())) {
            foreach ($this->getFilters() as $directoryFilter) {
                $fullPathCandidate = sprintf(
                    '%s/%s',
                    $this->getFabricationDirectoryPath(),
                    $directoryFilter
                );
                if ($this->getFilesystem()->exists($fullPathCandidate)) {
                    $this->addFullPath($fullPathCandidate);
                }
            }
        } else {
            $this->addFullPath($this->getFabricationDirectoryPath());
        }

        return $this;
    }

    protected function addSourceDirectoryPaths() : DiscoverableDirectoriesInterface
    {
        if (!empty($this->getFilters())) {
            foreach ($this->getFilters() as $directoryFilter) {
                $fullPathCandidate = sprintf('%s/%s', $this->getSourceDirectoryPath(), $directoryFilter);
                if ($this->getFilesystem()->exists($fullPathCandidate)) {
                    $this->addFullPath($fullPathCandidate);
                }
            }
        } else {
            $this->addFullPath($this->getSourceDirectoryPath());
        }

        return $this;
    }

    protected function addFullPath(string $fullPathCandidate) : DiscoverableDirectoriesInterface
    {
        if (!isset($this->full_paths[$fullPathCandidate])) {
            $this->full_paths[$fullPathCandidate] = $fullPathCandidate;
        } else {
            throw new \LogicException(
                sprintf(
                    'DiscoverableDirectories full path[%s] is already set.',
                    $fullPathCandidate
                )
            );
        }

        return $this;
    }

    protected function addWelcomeBaskets() : DiscoverableDirectoriesInterface
    {
        foreach ($this->getWelcomeBaskets()->getDirectoryPaths() as $directoryPath) {
            $this->addFullPath($directoryPath);
        }

        return $this;
    }

    public function getWelcomeBaskets() : Prefab5\WelcomeBasketsInterface
    {
        if ($this->welcome_baskets === null) {
            $welcomeBaskets = new Prefab5\WelcomeBaskets();
            $welcomeBaskets->setProteanContainerBuilderFilesystemProperties(
                $this->getProteanContainerBuilderFilesystemProperties()
            );
            $this->welcome_baskets = $welcomeBaskets;
        }

        return $this->welcome_baskets;
    }
}

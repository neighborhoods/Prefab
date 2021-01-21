<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class DiscoverableDirectories implements DiscoverableDirectoriesInterface
{
    use Prefab5\HTTPBuildableDirectoryMap\FilesystemProperties\AwareTrait;

    protected $directory_filters = [];
    protected $appended_paths = [];
    protected $welcome_baskets;

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

    public function getDirectoryPathFilters(): array
    {
        return $this->directory_filters;
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

    public function getAppendedPaths(): array
    {
        return $this->appended_paths;
    }

    public function getWelcomeBaskets() : Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories\WelcomeBasketsInterface
    {
        if ($this->welcome_baskets === null) {
            $welcomeBaskets = new Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories\WelcomeBaskets();
            $welcomeBaskets->setProteanContainerBuilderFilesystemProperties(
                $this->getProteanContainerBuilderFilesystemProperties()
            );
            $this->welcome_baskets = $welcomeBaskets;
        }

        return $this->welcome_baskets;
    }
}

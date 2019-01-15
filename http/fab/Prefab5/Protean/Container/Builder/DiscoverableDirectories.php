<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;
use Symfony\Component\Filesystem\Filesystem;

class DiscoverableDirectories implements DiscoverableDirectoriesInterface
{
    use Prefab5\Protean\Container\Builder\FilesystemProperties\AwareTrait;

    protected $directory_filters = [];
    protected $full_paths = [];
    protected $filesystem;
    protected $welcome_baskets;

    public function getFullPaths(): array
    {
        if (empty($this->full_paths)) {
            $this->addFullPath($this->getCacheDirectoryPath());
            if ($this->hasFilters()) {
                $this->addFabricationDirectoryPaths();
                $this->addSourceDirectoryPaths();
                $this->addWelcomeBaskets();
            } else {
                $this->addFullPath($this->getFabricationDirectoryPath());
                $this->addFullPath($this->getSourceDirectoryPath());
            }
        }

        return $this->full_paths;
    }

    protected function hasFilters(): bool
    {
        return !empty($this->directory_filters);
    }

    protected function getFilters(): array
    {
        return $this->directory_filters;
    }

    public function addDirectoryPathFilter(string $directoryPathFilter): DiscoverableDirectoriesInterface
    {
        if (isset($this->directory_filters[$directoryPathFilter])) {
            throw new \LogicException(
                sprintf('FilesystemProperties directory_filter[%s] is already set.', $directoryPathFilter)
            );
        }
        foreach ($this->directory_filters as $existingDirectoryFilter) {
            if (strpos($existingDirectoryFilter, $directoryPathFilter) === 0) {
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

    protected function getCacheDirectoryPath(): string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getCacheDirectoryPath();
    }

    protected function getFabricationDirectoryPath(): string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getFabricationDirectoryPath();
    }

    protected function getSourceDirectoryPath(): string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getSourceDirectoryPath();
    }

    protected function getFilesystem(): Filesystem
    {
        if ($this->filesystem === null) {
            $this->filesystem = new Filesystem();
        }

        return $this->filesystem;
    }

    protected function addFabricationDirectoryPaths(): DiscoverableDirectoriesInterface
    {
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

        return $this;
    }

    protected function addSourceDirectoryPaths(): DiscoverableDirectoriesInterface
    {
        foreach ($this->getFilters() as $directoryFilter) {
            $this->addFullPath(sprintf('%s/%s', $this->getSourceDirectoryPath(), $directoryFilter));
        }

        return $this;
    }

    protected function addFullPath(string $fullPathCandidate): DiscoverableDirectoriesInterface
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

    protected function addWelcomeBaskets(): DiscoverableDirectoriesInterface
    {
        foreach ($this->getWelcomeBaskets()->getDirectoryPaths() as $directoryPath) {
            $this->addFullPath($directoryPath);
        }
        
        return $this;
    }

    protected function getWelcomeBaskets(): Prefab5\WelcomeBasketsInterface
    {
        if ($this->welcome_baskets === null) {
            $this->welcome_baskets = new Prefab5\WelcomeBaskets();
        }

        return $this->welcome_baskets;
    }
}

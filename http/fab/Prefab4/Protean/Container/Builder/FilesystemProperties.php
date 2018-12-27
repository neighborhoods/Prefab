<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean\Container\Builder;

use Symfony\Component\Filesystem\Filesystem;
use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Protean;

class FilesystemProperties implements FilesystemPropertiesInterface
{
    use Protean\Container\Builder\AwareTrait;

    protected $filesystem;
    protected $root_directory_path;
    protected $directory_filters = [];
    protected $discoverable_directories;
    protected $prefab4_directory_path;

    public function getDiscoverableDirectories(): array
    {
        if ($this->discoverable_directories === null) {
            $discoverableDirectories[] = $this->getCacheDirectoryPath();
            if (empty($this->getDirectoryFilters())) {
                $discoverableDirectories[] = $this->getFabricationDirectoryPath();
                $discoverableDirectories[] = $this->getSourceDirectoryPath();
            } else {
                $discoverableDirectories[] = $this->getPrefab4DirectoryPath();
                foreach ($this->getDirectoryFilters() as $directoryFilter) {
                    $discoverableDirectories[] = sprintf(
                        '%s/%s',
                        $this->getFabricationDirectoryPath(),
                        $directoryFilter
                    );
                }
                foreach ($this->getDirectoryFilters() as $directoryFilter) {
                    $discoverableDirectories[] = sprintf('%s/%s', $this->getSourceDirectoryPath(), $directoryFilter);
                }
            }

            $this->discoverable_directories = $discoverableDirectories;
        }

        return $this->discoverable_directories;
    }

    protected function getDirectoryFilters(): array
    {
        return $this->directory_filters;
    }

    public function addDirectoryFilter(string $directoryFilter): FilesystemPropertiesInterface
    {
        if (isset($this->directory_filters[$directoryFilter])) {
            throw new \LogicException(
                sprintf('FilesystemProperties directory_filter[%s] is already set.', $directoryFilter)
            );
        }
        foreach ($this->directory_filters as $existingDirectoryFilter) {
            if (strpos($existingDirectoryFilter, $directoryFilter) === 0) {
                throw new \LogicException(
                    sprintf(
                        'FilesystemProperties directory_filter[%s] is a parent node of [%s].',
                        $existingDirectoryFilter,
                        $directoryFilter
                    )
                );
            }
        }

        $this->directory_filters[$directoryFilter] = $directoryFilter;

        return $this;
    }

    protected function getFabricationDirectoryPath(): string
    {
        if (!realpath($this->getRootDirectoryPath() . '/fab')) {
            $this->getFilesystem()->mkdir($this->getRootDirectoryPath() . '/fab');
        }

        return realpath($this->getRootDirectoryPath() . '/fab');
    }

    protected function getSourceDirectoryPath(): string
    {
        return realpath($this->getRootDirectoryPath() . '/src');
    }

    protected function getCacheDirectoryPath(): string
    {
        if (!realpath($this->getRootDirectoryPath() . '/data/cache')) {
            $this->getFilesystem()->mkdir($this->getRootDirectoryPath() . '/data/cache');
        }

        return realpath($this->getRootDirectoryPath() . '/data/cache');
    }

    public function getPipelineFilePath(): string
    {
        return $this->getConfigurationDirectoryPath() . '/pipeline.php';
    }

    public function getZendConfigContainerFilePath(): string
    {
        return $this->getConfigurationDirectoryPath() . '/container.php';
    }

    protected function getConfigurationDirectoryPath(): string
    {
        if (!realpath($this->getRootDirectoryPath() . '/config')) {
            $this->getFilesystem()->mkdir($this->getRootDirectoryPath() . '/config');
        }

        return realpath($this->getRootDirectoryPath() . '/config');
    }

    public function getExpressiveDIYAMLFilePath(): string
    {
        return $this->getCacheDirectoryPath() . '/expressive.service.yml';
    }

    public function getSymfonyContainerFilePath(): string
    {
        $symfonyContainerFilePath = sprintf(
            '%s/%s.php',
            $this->getCacheDirectoryPath(),
            $this->getProteanContainerBuilder()->getContainerName()
        );

        return $symfonyContainerFilePath;
    }

    public function setRootDirectoryPath(string $rootDirectoryPath): FilesystemPropertiesInterface
    {
        if ($this->root_directory_path === null) {
            $rootDirectoryPath = realpath(rtrim($rootDirectoryPath, "/"));
            if (is_dir($rootDirectoryPath)) {
                $this->root_directory_path = $rootDirectoryPath;
            } else {
                $message = sprintf('Root directory path[%s] is not a directory.', $rootDirectoryPath);
                throw new \UnexpectedValueException($message);
            }
        } else {
            throw new \LogicException('Root directory path is already set.');
        }

        return $this;
    }

    public function getRootDirectoryPath(): string
    {
        if ($this->root_directory_path === null) {
            throw new \LogicException('Root directory path is not set.');
        }

        return $this->root_directory_path;
    }

    protected function getFilesystem(): Filesystem
    {
        if ($this->filesystem === null) {
            $this->filesystem = new Filesystem();
        }

        return $this->filesystem;
    }

    public function getPrefab4DirectoryPath()
    {
        if ($this->prefab4_directory_path === null) {
            $this->prefab4_directory_path = sprintf('%s/Prefab4', $this->getFabricationDirectoryPath());
        }

        return $this->prefab4_directory_path;
    }
}

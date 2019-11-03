<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

use Symfony\Component\Filesystem\Filesystem;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;

class FilesystemProperties implements FilesystemPropertiesInterface
{
    use Protean\Container\Builder\AwareTrait;

    protected $filesystem;
    protected $root_directory_path;
    protected $prefab5_directory_path;
    protected $cache_directory_path;
    protected $fabrication_directory_path;
    protected $source_directory_path;
    protected $data_directory_path;
    protected $pipeline_file_path;
    protected $config_directory_path;
    protected $zend_config_container_file_path;
    protected $zend_cache_directory_path;

    public function getFabricationDirectoryPath(): string
    {
        if ($this->fabrication_directory_path === null) {
            $this->fabrication_directory_path = $this->getRealDirectoryPath($this->getRootDirectoryPath(), 'fab');
        }

        return $this->fabrication_directory_path;
    }

    public function getSourceDirectoryPath(): string
    {
        if ($this->source_directory_path === null) {
            $this->source_directory_path = $this->getRealDirectoryPath($this->getRootDirectoryPath(), 'src');
        }

        return $this->source_directory_path;
    }

    protected function getRealDirectoryPath(string $parentDirectoryPath, string $directoryName): string
    {
        $directoryPath = sprintf('%s/%s', $parentDirectoryPath, $directoryName);
        if (!realpath($directoryPath)) {
            $this->getFilesystem()->mkdir($directoryPath);
        }

        return realpath($directoryPath);
    }

    public function getCacheDirectoryPath(): string
    {
        if ($this->cache_directory_path === null) {
            $this->cache_directory_path = $this->getRealDirectoryPath($this->getDataDirectoryPath(), 'cache');
        }

        return $this->cache_directory_path;
    }


    protected function getDataDirectoryPath(): string
    {
        if ($this->data_directory_path === null) {
            $this->data_directory_path = $this->getRealDirectoryPath($this->getRootDirectoryPath(), 'data');
        }

        return $this->data_directory_path;
    }

    public function getPipelineFilePath(): string
    {
        if ($this->pipeline_file_path === null) {
            $this->pipeline_file_path = realpath(sprintf('%s/pipeline.php', $this->getConfigurationDirectoryPath()));
        }

        return $this->pipeline_file_path;
    }

    public function getZendConfigContainerFilePath(): string
    {
        if ($this->zend_config_container_file_path === null) {
            $this->zend_config_container_file_path = realpath(
                sprintf(
                    '%s/container.php',
                    $this->getConfigurationDirectoryPath()
                )
            );
        }

        return $this->zend_config_container_file_path;
    }

    protected function getConfigurationDirectoryPath(): string
    {
        if ($this->config_directory_path === null) {
            $this->config_directory_path = $this->getRealDirectoryPath($this->getRootDirectoryPath(), 'config');
        }

        return $this->config_directory_path;
    }

    public function getExpressiveDIYAMLFilePath(): string
    {
        return sprintf('%s/expressive.service.yml', $this->getZendCacheDirectoryPath());
    }

    public function getZendCacheDirectoryPath(): string
    {
        if ($this->zend_cache_directory_path === null) {
            $this->zend_cache_directory_path = $this->getRealDirectoryPath($this->getCacheDirectoryPath(), 'zend');
        }

        return $this->zend_cache_directory_path;
    }

    public function getPrefab5DirectoryPath()
    {
        if ($this->prefab5_directory_path === null) {
            $this->prefab5_directory_path = sprintf('%s/Prefab5', $this->getFabricationDirectoryPath());
        }

        return $this->prefab5_directory_path;
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
}

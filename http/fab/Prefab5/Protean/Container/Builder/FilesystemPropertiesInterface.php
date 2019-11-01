<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

interface FilesystemPropertiesInterface
{
    public function getPipelineFilePath(): string;

    public function getExpressiveDIYAMLFilePath(): string;

    public function getZendConfigContainerFilePath(): string;

    public function getRootDirectoryPath(): string;

    public function getSymfonyContainerFilePath(): string;

    public function setRootDirectoryPath(string $rootDirectoryPath): FilesystemPropertiesInterface;

    public function getCacheDirectoryPath(): string;

    public function getFabricationDirectoryPath(): string;

    public function getSourceDirectoryPath(): string;

    public function getPrefab5DirectoryPath();

    public function getZendCacheDirectoryPath(): string;
}

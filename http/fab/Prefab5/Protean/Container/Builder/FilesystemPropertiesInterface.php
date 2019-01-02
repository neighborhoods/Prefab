<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

interface FilesystemPropertiesInterface
{
    public function getPipelineFilePath(): string;

    public function getExpressiveDIYAMLFilePath(): string;

    public function getZendConfigContainerFilePath(): string;

    public function getRootDirectoryPath(): string;

    public function getSymfonyContainerFilePath(): string;

    public function getDiscoverableDirectories(): array;

    public function setRootDirectoryPath(string $rootDirectoryPath): FilesystemPropertiesInterface;

    public function addDirectoryFilter(string $directoryFilter): FilesystemPropertiesInterface;
}

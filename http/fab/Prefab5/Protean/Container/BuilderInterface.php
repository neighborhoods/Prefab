<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemProperties;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemPropertiesInterface;
use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(): ContainerInterface;

    public function registerServiceAsPublic(string $serviceId): BuilderInterface;

    public function buildZendExpressive(): BuilderInterface;

    public function setCanBuildZendExpressive(bool $canBuildZendExpressive): BuilderInterface;

    public function setContainerName(string $containerName): BuilderInterface;

    public function getContainerName(): string;

    public function getFilesystemProperties(): FilesystemPropertiesInterface;

    public function getDiscoverableDirectories(): DiscoverableDirectoriesInterface;
}

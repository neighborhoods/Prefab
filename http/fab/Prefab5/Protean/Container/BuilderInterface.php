<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\FilesystemPropertiesInterface;
use Psr\Container\ContainerInterface;

interface BuilderInterface
{
    public function build(): ContainerInterface;

    public function registerServiceAsPublic(string $serviceId): BuilderInterface;

    public function setContainerName(string $containerName): BuilderInterface;

    public function getContainerName(): string;

    public function getDiscoverableDirectories(): DiscoverableDirectoriesInterface;

    public function setDiscoverableDirectories(DiscoverableDirectoriesInterface $discoverableDirectories): BuilderInterface;

    public function setFilesystemProperties(FilesystemPropertiesInterface $filesystemProperties): BuilderInterface;
}

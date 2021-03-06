<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use Psr\Container\ContainerInterface;

interface ContainerBuilderInterface
{
    public function setDirectoryGroup(string $directoryGroup) : ContainerBuilderInterface;

    public function setBuildableDirectoryMap(array $buildableDirectoryMap) : ContainerBuilderInterface;

    public function setRootDirectoryPath(string $rootDirectoryPath): ContainerBuilderInterface;

    public function build(): ContainerInterface;
}

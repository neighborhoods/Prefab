<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean;

interface ContainerBuilderInterface
{
    public function setDirectoryGroup(string $directoryGroup) : ContainerBuilderInterface;

    public function setBuildableDirectoryMap(array $buildableDirectoryMap) : ContainerBuilderInterface;

    public function getContainerBuilder() : Protean\Container\BuilderInterface;
}

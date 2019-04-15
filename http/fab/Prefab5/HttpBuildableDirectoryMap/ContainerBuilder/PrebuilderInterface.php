<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\ContainerBuilder;

interface PrebuilderInterface
{
    public function prebuildContainers() : PrebuilderInterface;
}

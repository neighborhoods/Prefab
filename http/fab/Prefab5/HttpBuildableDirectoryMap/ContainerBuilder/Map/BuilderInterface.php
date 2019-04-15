<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder\MapInterface;

interface BuilderInterface
{
    public function build() : MapInterface;

    public function setRecords(array $record) : BuilderInterface;
}

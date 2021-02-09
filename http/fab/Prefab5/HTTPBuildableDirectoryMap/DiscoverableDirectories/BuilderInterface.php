<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectoriesInterface;

interface BuilderInterface
{
    public function build(): DiscoverableDirectoriesInterface;

    public function setDirectoryGroupName(string $directoryGroupName): BuilderInterface;

    public function setRecord(array $record): BuilderInterface;
}

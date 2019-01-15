<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder;

interface DiscoverableDirectoriesInterface
{
    public function addDirectoryPathFilter(string $directoryPathFilter): DiscoverableDirectoriesInterface;

    public function getFullPaths(): array;
}

<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

interface DiscoverableDirectoriesInterface
{
    public function addDirectoryPathFilter(string $directoryPathFilter): DiscoverableDirectoriesInterface;

    public function getFullPaths(): array;

    public function getWelcomeBaskets(): Prefab5\HTTPBuildableDirectoryMap\DiscoverableDirectories\WelcomeBasketsInterface;

    public function appendPath(string $path): DiscoverableDirectoriesInterface;
}

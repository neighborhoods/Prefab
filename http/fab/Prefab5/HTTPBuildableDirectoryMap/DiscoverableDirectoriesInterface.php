<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

interface DiscoverableDirectoriesInterface
{
    public function addDirectoryPathFilter(string $directoryPathFilter): DiscoverableDirectoriesInterface;

    public function getDirectoryPathFilters(): array;

    public function getWelcomeBaskets(): DiscoverableDirectories\WelcomeBasketsInterface;

    public function appendPath(string $path): DiscoverableDirectoriesInterface;

    public function getAppendedPaths(): array;
}

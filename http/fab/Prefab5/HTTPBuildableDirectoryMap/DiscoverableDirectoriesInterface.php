<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\HTTPBuildableDirectoryMap;

interface DiscoverableDirectoriesInterface
{
    public function addDirectoryPathFilter(string $directoryPathFilter): DiscoverableDirectoriesInterface;

    public function getDirectoryPathFilters(): array;

    public function addWelcomeBasket(string $welcomeBasket): DiscoverableDirectoriesInterface;

    public function getWelcomeBaskets(): array;

    public function appendPath(string $path): DiscoverableDirectoriesInterface;

    public function getAppendedPaths(): array;

    public function getDirectoryGroupName(): string;

    public function setDirectoryGroupName(string $directoryGroupName): DiscoverableDirectoriesInterface;
}

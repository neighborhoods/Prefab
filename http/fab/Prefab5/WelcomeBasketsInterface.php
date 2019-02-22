<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

interface WelcomeBasketsInterface
{
    public function getDirectoryPaths(): array;

    public function addBuildableDirectory(string $welcomeBasketRelativeDirectoryPath): WelcomeBasketsInterface;
}

<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

interface WelcomeBasketsInterface
{
    public function getDirectoryPaths(): array;

    public function addWelcomeBasket(string $welcomeBasketRelativeDirectoryPath): WelcomeBasketsInterface;

    public function getWelcomeBasketDirectories(): array;
}

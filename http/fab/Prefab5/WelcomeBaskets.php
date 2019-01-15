<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

class WelcomeBaskets implements WelcomeBasketsInterface
{
    use Prefab5\Protean\Container\Builder\FilesystemProperties\AwareTrait;

    protected $discoverable_directories = [];
    protected $exclusions = [];

    protected function addExclusion(string $welcomeBasketRelativeDirectoryPath): WelcomeBasketsInterface
    {
        if (!isset($this->exclusions[$welcomeBasketRelativeDirectoryPath])) {
            $this->exclusions[$welcomeBasketRelativeDirectoryPath] = $welcomeBasketRelativeDirectoryPath;
        } else {
            throw new \LogicException(
                sprintf(
                    'WelcomeBasket exclusion[%s] is already set.',
                    $welcomeBasketRelativeDirectoryPath
                )
            );
        }

        return $this;
    }

    public function getDirectoryPaths(): array
    {
        if ($this->discoverable_directories === null) {

        }

        return $this->discoverable_directories;
    }
}

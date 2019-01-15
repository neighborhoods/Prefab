<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class WelcomeBaskets implements WelcomeBasketsInterface
{
    use Prefab5\Protean\Container\Builder\FilesystemProperties\AwareTrait;

    protected $directory_paths = [];
    protected $exclusions = [];
    protected $finder;

    public function addExclusion(string $welcomeBasketRelativeDirectoryPath): WelcomeBasketsInterface
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
        if (empty($this->directory_paths)) {
            foreach ($this->exclusions as $exclusion) {
                $this->getFinder()->notPath($exclusion);
            }
            /** @var SplFileInfo $directory */
            foreach ($this->getFinder()->in($this->getPrefab5DirectoryPath())->directories() as $directory) {
                $this->directory_paths[] = $directory->getPathname();
            }
        }

        return $this->directory_paths;
    }

    protected function getFinder(): Finder
    {
        if ($this->finder === null) {
            $this->finder = new Finder();
        }

        return $this->finder;
    }

    protected function getPrefab5DirectoryPath(): string
    {
        return $this->getProteanContainerBuilderFilesystemProperties()->getPrefab5DirectoryPath();
    }
}

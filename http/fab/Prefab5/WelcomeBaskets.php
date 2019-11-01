<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class WelcomeBaskets implements WelcomeBasketsInterface
{
    use Prefab5\Protean\Container\Builder\FilesystemProperties\AwareTrait;

    protected $directory_paths = [];
    protected $buildableDirectory = [];
    protected $directoryParentNodes;
    protected $finder;

    public function addWelcomeBasket(string $welcomeBasketRelativeDirectoryPath): WelcomeBasketsInterface
    {
        if (!isset($this->buildableDirectory[$welcomeBasketRelativeDirectoryPath])) {
            $this->buildableDirectory[$welcomeBasketRelativeDirectoryPath] = $welcomeBasketRelativeDirectoryPath;
        } else {
            throw new \LogicException(
                sprintf(
                    'WelcomeBasket buildableDirectory[%s] is already set.',
                    $welcomeBasketRelativeDirectoryPath
                )
            );
        }

        return $this;
    }

    public function getDirectoryPaths(): array
    {
        if (empty($this->directory_paths)) {

            /** @var SplFileInfo $directory */
            foreach ($this->getFinder()->in($this->getPrefab5DirectoryPath())->directories() as $directory) {
                $this->directory_paths[$directory->getPathname()] = $directory->getPathname();
            }

            $this->directory_paths = array_intersect($this->directory_paths, $this->getWelcomeBasketDirectories());
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

    public function getWelcomeBasketDirectories(): array
    {
        if ($this->directoryParentNodes === null) {
            $this->directoryParentNodes = [];
            foreach ($this->buildableDirectory as $directory) {
                $directoryParts = explode('\\', $directory);

                foreach ($directoryParts as $directoryPart) {
                    $parentNode = sprintf('%s/%s', $this->getPrefab5DirectoryPath(), $directoryPart);
                    $this->directoryParentNodes[$parentNode] = $parentNode;
                }
            }

        }

        return $this->directoryParentNodes;
    }
}

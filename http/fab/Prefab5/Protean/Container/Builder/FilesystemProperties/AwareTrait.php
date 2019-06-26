<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemProperties;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Protean\Container\Builder\FilesystemPropertiesInterface;

trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties;

    public function setProteanContainerBuilderFilesystemProperties(FilesystemPropertiesInterface $proteanContainerBuilderFilesystemProperties): self
    {
        if ($this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties = $proteanContainerBuilderFilesystemProperties;

        return $this;
    }

    protected function getProteanContainerBuilderFilesystemProperties(): FilesystemPropertiesInterface
    {
        if (!$this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties;
    }

    protected function hasProteanContainerBuilderFilesystemProperties(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties);
    }

    protected function unsetProteanContainerBuilderFilesystemProperties(): self
    {
        if (!$this->hasProteanContainerBuilderFilesystemProperties()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductProteanContainerBuilderFilesystemProperties);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map\Generator\Factory;

use Neighborhoods\Prefab\Actor\Map\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapGeneratorFactory;

    public function setMapGeneratorFactory(FactoryInterface $mapGeneratorFactory): self
    {
        if ($this->hasMapGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabMapGeneratorFactory = $mapGeneratorFactory;

        return $this;
    }

    protected function getMapGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasMapGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabMapGeneratorFactory;
    }

    protected function hasMapGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabMapGeneratorFactory);
    }

    protected function unsetMapGeneratorFactory(): self
    {
        if (!$this->hasMapGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabMapGeneratorFactory);

        return $this;
    }
}

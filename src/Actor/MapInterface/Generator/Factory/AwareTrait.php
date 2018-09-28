<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapInterface\Generator\Factory;

use Neighborhoods\Prefab\Actor\MapInterface\Generator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabMapInterfaceGeneratorFactory;

    public function setMapInterfaceGeneratorFactory(FactoryInterface $mapInterfaceGeneratorFactory): self
    {
        if ($this->hasMapInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGeneratorFactory is already set.');
        }
        $this->NeighborhoodsPrefabMapInterfaceGeneratorFactory = $mapInterfaceGeneratorFactory;

        return $this;
    }

    protected function getMapInterfaceGeneratorFactory(): FactoryInterface
    {
        if (!$this->hasMapInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGeneratorFactory is not set.');
        }

        return $this->NeighborhoodsPrefabMapInterfaceGeneratorFactory;
    }

    protected function hasMapInterfaceGeneratorFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabMapInterfaceGeneratorFactory);
    }

    protected function unsetMapInterfaceGeneratorFactory(): self
    {
        if (!$this->hasMapInterfaceGeneratorFactory()) {
            throw new \LogicException('NeighborhoodsPrefabMapInterfaceGeneratorFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabMapInterfaceGeneratorFactory);

        return $this;
    }
}

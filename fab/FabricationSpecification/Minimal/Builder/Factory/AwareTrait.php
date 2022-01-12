<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimalBuilderFactory;

    public function setFabricationSpecificationMinimalBuilderFactory(FactoryInterface $MinimalBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationMinimalBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilderFactory is already set.');
        }
        $this->FabricationSpecificationMinimalBuilderFactory = $MinimalBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationMinimalBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationMinimalBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationMinimalBuilderFactory;
    }

    protected function hasFabricationSpecificationMinimalBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationMinimalBuilderFactory);
    }

    protected function unsetFabricationSpecificationMinimalBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationMinimalBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationMinimalBuilderFactory);

        return $this;
    }
}

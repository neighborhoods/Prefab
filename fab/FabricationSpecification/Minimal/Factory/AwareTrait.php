<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimalFactory;

    public function setFabricationSpecificationMinimalFactory(FactoryInterface $MinimalFactory): self
    {
        if ($this->hasFabricationSpecificationMinimalFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalFactory is already set.');
        }
        $this->FabricationSpecificationMinimalFactory = $MinimalFactory;

        return $this;
    }

    protected function getFabricationSpecificationMinimalFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationMinimalFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalFactory is not set.');
        }

        return $this->FabricationSpecificationMinimalFactory;
    }

    protected function hasFabricationSpecificationMinimalFactory(): bool
    {
        return isset($this->FabricationSpecificationMinimalFactory);
    }

    protected function unsetFabricationSpecificationMinimalFactory(): self
    {
        if (!$this->hasFabricationSpecificationMinimalFactory()) {
            throw new \LogicException('FabricationSpecificationMinimalFactory is not set.');
        }
        unset($this->FabricationSpecificationMinimalFactory);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationBuilderFactory;

    public function setFabricationSpecificationBuilderFactory(FactoryInterface $FabricationSpecificationBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationBuilderFactory is already set.');
        }
        $this->FabricationSpecificationBuilderFactory = $FabricationSpecificationBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationBuilderFactory;
    }

    protected function hasFabricationSpecificationBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationBuilderFactory);
    }

    protected function unsetFabricationSpecificationBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationBuilderFactory);

        return $this;
    }
}

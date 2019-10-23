<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\Factory;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationAllSupportingActorsBuilderFactory;

    public function setFabricationSpecificationAllSupportingActorsBuilderFactory(FactoryInterface $AllSupportingActorsBuilderFactory): self
    {
        if ($this->hasFabricationSpecificationAllSupportingActorsBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilderFactory is already set.');
        }
        $this->FabricationSpecificationAllSupportingActorsBuilderFactory = $AllSupportingActorsBuilderFactory;

        return $this;
    }

    protected function getFabricationSpecificationAllSupportingActorsBuilderFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilderFactory is not set.');
        }

        return $this->FabricationSpecificationAllSupportingActorsBuilderFactory;
    }

    protected function hasFabricationSpecificationAllSupportingActorsBuilderFactory(): bool
    {
        return isset($this->FabricationSpecificationAllSupportingActorsBuilderFactory);
    }

    protected function unsetFabricationSpecificationAllSupportingActorsBuilderFactory(): self
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsBuilderFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsBuilderFactory is not set.');
        }
        unset($this->FabricationSpecificationAllSupportingActorsBuilderFactory);

        return $this;
    }
}

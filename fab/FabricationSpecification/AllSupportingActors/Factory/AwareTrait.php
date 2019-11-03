<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Factory;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\FactoryInterface;

trait AwareTrait
{
    protected $FabricationSpecificationAllSupportingActorsFactory;

    public function setFabricationSpecificationAllSupportingActorsFactory(FactoryInterface $AllSupportingActorsFactory): self
    {
        if ($this->hasFabricationSpecificationAllSupportingActorsFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsFactory is already set.');
        }
        $this->FabricationSpecificationAllSupportingActorsFactory = $AllSupportingActorsFactory;

        return $this;
    }

    protected function getFabricationSpecificationAllSupportingActorsFactory(): FactoryInterface
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsFactory is not set.');
        }

        return $this->FabricationSpecificationAllSupportingActorsFactory;
    }

    protected function hasFabricationSpecificationAllSupportingActorsFactory(): bool
    {
        return isset($this->FabricationSpecificationAllSupportingActorsFactory);
    }

    protected function unsetFabricationSpecificationAllSupportingActorsFactory(): self
    {
        if (!$this->hasFabricationSpecificationAllSupportingActorsFactory()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActorsFactory is not set.');
        }
        unset($this->FabricationSpecificationAllSupportingActorsFactory);

        return $this;
    }
}

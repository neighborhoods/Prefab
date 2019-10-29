<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecificationAllSupportingActors;

    public function setFabricationSpecificationAllSupportingActors(FabricationSpecificationInterface $AllSupportingActors): self
    {
        if ($this->hasFabricationSpecificationAllSupportingActors()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActors is already set.');
        }
        $this->FabricationSpecificationAllSupportingActors = $AllSupportingActors;

        return $this;
    }

    protected function getFabricationSpecificationAllSupportingActors(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecificationAllSupportingActors()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActors is not set.');
        }

        return $this->FabricationSpecificationAllSupportingActors;
    }

    protected function hasFabricationSpecificationAllSupportingActors(): bool
    {
        return isset($this->FabricationSpecificationAllSupportingActors);
    }

    protected function unsetFabricationSpecificationAllSupportingActors(): self
    {
        if (!$this->hasFabricationSpecificationAllSupportingActors()) {
            throw new \LogicException('FabricationSpecificationAllSupportingActors is not set.');
        }
        unset($this->FabricationSpecificationAllSupportingActors);

        return $this;
    }
}

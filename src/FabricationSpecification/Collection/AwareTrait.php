<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecificationCollection;

    public function setFabricationSpecificationCollection(FabricationSpecificationInterface $Collection): self
    {
        if ($this->hasFabricationSpecificationCollection()) {
            throw new \LogicException('FabricationSpecificationCollection is already set.');
        }
        $this->FabricationSpecificationCollection = $Collection;

        return $this;
    }

    protected function getFabricationSpecificationCollection(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecificationCollection()) {
            throw new \LogicException('FabricationSpecificationCollection is not set.');
        }

        return $this->FabricationSpecificationCollection;
    }

    protected function hasFabricationSpecificationCollection(): bool
    {
        return isset($this->FabricationSpecificationCollection);
    }

    protected function unsetFabricationSpecificationCollection(): self
    {
        if (!$this->hasFabricationSpecificationCollection()) {
            throw new \LogicException('FabricationSpecificationCollection is not set.');
        }
        unset($this->FabricationSpecificationCollection);

        return $this;
    }
}

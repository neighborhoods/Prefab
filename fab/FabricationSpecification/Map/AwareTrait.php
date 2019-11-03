<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Map;

use Neighborhoods\Prefab\FabricationSpecification\MapInterface;

trait AwareTrait
{
    protected $FabricationSpecifications;

    public function setFabricationSpecificationMap(MapInterface $FabricationSpecifications): self
    {
        if ($this->hasFabricationSpecificationMap()) {
            throw new \LogicException('FabricationSpecifications is already set.');
        }
        $this->FabricationSpecifications = $FabricationSpecifications;

        return $this;
    }

    protected function getFabricationSpecificationMap(): MapInterface
    {
        if (!$this->hasFabricationSpecificationMap()) {
            throw new \LogicException('FabricationSpecifications is not set.');
        }

        return $this->FabricationSpecifications;
    }

    protected function hasFabricationSpecificationMap(): bool
    {
        return isset($this->FabricationSpecifications);
    }

    protected function unsetFabricationSpecificationMap(): self
    {
        if (!$this->hasFabricationSpecificationMap()) {
            throw new \LogicException('FabricationSpecifications is not set.');
        }
        unset($this->FabricationSpecifications);

        return $this;
    }
}

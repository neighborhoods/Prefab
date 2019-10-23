<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimal;

    public function setFabricationSpecificationMinimal(FabricationSpecificationInterface $Minimal): self
    {
        if ($this->hasFabricationSpecificationMinimal()) {
            throw new \LogicException('FabricationSpecificationMinimal is already set.');
        }
        $this->FabricationSpecificationMinimal = $Minimal;

        return $this;
    }

    protected function getFabricationSpecificationMinimal(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecificationMinimal()) {
            throw new \LogicException('FabricationSpecificationMinimal is not set.');
        }

        return $this->FabricationSpecificationMinimal;
    }

    protected function hasFabricationSpecificationMinimal(): bool
    {
        return isset($this->FabricationSpecificationMinimal);
    }

    protected function unsetFabricationSpecificationMinimal(): self
    {
        if (!$this->hasFabricationSpecificationMinimal()) {
            throw new \LogicException('FabricationSpecificationMinimal is not set.');
        }
        unset($this->FabricationSpecificationMinimal);

        return $this;
    }
}

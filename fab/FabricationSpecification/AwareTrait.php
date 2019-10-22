<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecification;

    public function setFabricationSpecification(FabricationSpecificationInterface $FabricationSpecification): self
    {
        if ($this->hasFabricationSpecification()) {
            throw new \LogicException('FabricationSpecification is already set.');
        }
        $this->FabricationSpecification = $FabricationSpecification;

        return $this;
    }

    protected function getFabricationSpecification(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecification()) {
            throw new \LogicException('FabricationSpecification is not set.');
        }

        return $this->FabricationSpecification;
    }

    protected function hasFabricationSpecification(): bool
    {
        return isset($this->FabricationSpecification);
    }

    protected function unsetFabricationSpecification(): self
    {
        if (!$this->hasFabricationSpecification()) {
            throw new \LogicException('FabricationSpecification is not set.');
        }
        unset($this->FabricationSpecification);

        return $this;
    }
}

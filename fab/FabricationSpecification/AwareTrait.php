<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecification;

    public function setFabricationSpecification(FabricationSpecificationInterface $FabricationSpecification): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->FabricationSpecification = $FabricationSpecification;

        return $this;
    }

    protected function getFabricationSpecification(): FabricationSpecificationInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->FabricationSpecification;
    }

    protected function hasActor(): bool
    {
        return isset($this->FabricationSpecification);
    }

    protected function unsetFabricationSpecification(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->FabricationSpecification);

        return $this;
    }
}

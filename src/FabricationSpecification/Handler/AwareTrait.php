<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

trait AwareTrait
{
    protected $FabricationSpecificationHandler;

    public function setFabricationSpecificationHandler(FabricationSpecificationInterface $Handler): self
    {
        if ($this->hasFabricationSpecificationAllHandler()) {
            throw new \LogicException('FabricationSpecificationHandler is already set.');
        }
        $this->FabricationSpecificationHandler = $Handler;

        return $this;
    }

    protected function getFabricationSpecificationHandler(): FabricationSpecificationInterface
    {
        if (!$this->hasFabricationSpecificationAllHandler()) {
            throw new \LogicException('FabricationSpecificationHandler is not set.');
        }

        return $this->FabricationSpecificationHandler;
    }

    protected function hasFabricationSpecificationAllHandler(): bool
    {
        return isset($this->FabricationSpecificationHandler);
    }

    protected function unsetFabricationSpecificationHandler(): self
    {
        if (!$this->hasFabricationSpecificationAllHandler()) {
            throw new \LogicException('FabricationSpecificationHandler is not set.');
        }
        unset($this->FabricationSpecificationHandler);

        return $this;
    }
}

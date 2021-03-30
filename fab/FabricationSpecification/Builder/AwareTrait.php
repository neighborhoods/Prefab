<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Builder;

use Neighborhoods\Prefab\FabricationSpecification\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationBuilder;

    public function setFabricationSpecificationBuilder(BuilderInterface $FabricationSpecificationBuilder): self
    {
        if ($this->hasFabricationSpecificationBuilder()) {
            throw new \LogicException('FabricationSpecificationBuilder is already set.');
        }
        $this->FabricationSpecificationBuilder = $FabricationSpecificationBuilder;

        return $this;
    }

    protected function getFabricationSpecificationBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationBuilder()) {
            throw new \LogicException('FabricationSpecificationBuilder is not set.');
        }

        return $this->FabricationSpecificationBuilder;
    }

    protected function hasFabricationSpecificationBuilder(): bool
    {
        return isset($this->FabricationSpecificationBuilder);
    }

    protected function unsetFabricationSpecificationBuilder(): self
    {
        if (!$this->hasFabricationSpecificationBuilder()) {
            throw new \LogicException('FabricationSpecificationBuilder is not set.');
        }
        unset($this->FabricationSpecificationBuilder);

        return $this;
    }
}

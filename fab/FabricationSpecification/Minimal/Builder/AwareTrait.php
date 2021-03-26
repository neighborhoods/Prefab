<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimalBuilder;

    public function setFabricationSpecificationMinimalBuilder(BuilderInterface $MinimalBuilder): self
    {
        if ($this->hasFabricationSpecificationMinimalBuilder()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilder is already set.');
        }
        $this->FabricationSpecificationMinimalBuilder = $MinimalBuilder;

        return $this;
    }

    protected function getFabricationSpecificationMinimalBuilder(): BuilderInterface
    {
        if (!$this->hasFabricationSpecificationMinimalBuilder()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilder is not set.');
        }

        return $this->FabricationSpecificationMinimalBuilder;
    }

    protected function hasFabricationSpecificationMinimalBuilder(): bool
    {
        return isset($this->FabricationSpecificationMinimalBuilder);
    }

    protected function unsetFabricationSpecificationMinimalBuilder(): self
    {
        if (!$this->hasFabricationSpecificationMinimalBuilder()) {
            throw new \LogicException('FabricationSpecificationMinimalBuilder is not set.');
        }
        unset($this->FabricationSpecificationMinimalBuilder);

        return $this;
    }
}

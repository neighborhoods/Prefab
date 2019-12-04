<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationMinimalBuilder;

    public function setFabricationSpecificationMinimalBuilder(BuilderInterface $MinimalBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->FabricationSpecificationMinimalBuilder = $MinimalBuilder;

        return $this;
    }

    protected function getFabricationSpecificationMinimalBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->FabricationSpecificationMinimalBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->FabricationSpecificationMinimalBuilder);
    }

    protected function unsetFabricationSpecificationMinimalBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->FabricationSpecificationMinimalBuilder);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Builder;

use Neighborhoods\Prefab\FabricationSpecification\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationBuilder;

    public function setFabricationSpecificationBuilder(BuilderInterface $FabricationSpecificationBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->FabricationSpecificationBuilder = $FabricationSpecificationBuilder;

        return $this;
    }

    protected function getFabricationSpecificationBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->FabricationSpecificationBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->FabricationSpecificationBuilder);
    }

    protected function unsetFabricationSpecificationBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->FabricationSpecificationBuilder);

        return $this;
    }
}

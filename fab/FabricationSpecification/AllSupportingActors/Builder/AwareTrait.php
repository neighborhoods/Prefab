<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\BuilderInterface;

trait AwareTrait
{
    protected $FabricationSpecificationAllSupportingActorsBuilder;

    public function setFabricationSpecificationAllSupportingActorsBuilder(BuilderInterface $AllSupportingActorsBuilder): self
    {
        if ($this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is already set.');
        }
        $this->FabricationSpecificationAllSupportingActorsBuilder = $AllSupportingActorsBuilder;

        return $this;
    }

    protected function getFabricationSpecificationAllSupportingActorsBuilder(): BuilderInterface
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }

        return $this->FabricationSpecificationAllSupportingActorsBuilder;
    }

    protected function hasActorBuilder(): bool
    {
        return isset($this->FabricationSpecificationAllSupportingActorsBuilder);
    }

    protected function unsetFabricationSpecificationAllSupportingActorsBuilder(): self
    {
        if (!$this->hasActorBuilder()) {
            throw new \LogicException('ActorBuilder is not set.');
        }
        unset($this->FabricationSpecificationAllSupportingActorsBuilder);

        return $this;
    }
}

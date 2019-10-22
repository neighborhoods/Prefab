<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class FabricationSpecification implements FabricationSpecificationInterface
{
    protected $actorMap;

    public function getActorMap() : Actor\MapInterface
    {
        if ($this->actorMap === null) {
            throw new \LogicException('FabricationSpecification actorMap has not been set.');
        }
        return $this->actorMap;
    }

    public function setActorMap(Actor\MapInterface $actorMap) : FabricationSpecificationInterface
    {
        if ($this->actorMap !== null) {
            throw new \LogicException('FabricationSpecification actorMap is already set.');
        }
        $this->actorMap = $actorMap;
        return $this;
    }

}

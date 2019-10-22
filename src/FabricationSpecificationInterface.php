<?php

namespace Neighborhoods\Prefab;

interface FabricationSpecificationInterface
{
    public function getActorMap() : Actor\MapInterface;

    public function setActorMap(Actor\MapInterface $actorMap) : FabricationSpecificationInterface;
}

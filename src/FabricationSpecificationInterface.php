<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface FabricationSpecificationInterface
{
     public function getActorMap(): \Neighborhoods\Prefab\Actor\MapInterface;
     public function setActorMap(\Neighborhoods\Prefab\Actor\MapInterface $actorMap): FabricationSpecificationInterface;
}

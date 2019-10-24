<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface FabricationSpecificationInterface
{
     public function getFabricationSpecificationMap(): \Neighborhoods\Prefab\MapInterface;
     public function setFabricationSpecificationMap(\Neighborhoods\Prefab\MapInterface $actorMap): FabricationSpecificationInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class FabricationSpecification implements FabricationSpecificationInterface
{
    /** @var \Neighborhoods\Prefab\MapInterface */
    private $actorMap;

     public function getFabricationSpecificationMap(): \Neighborhoods\Prefab\MapInterface
     {
         if ($this->actorMap === null) {
             throw new \LogicException('actorMap has not been set');
         }
         
         return $this->actorMap;
     }
     
     public function setFabricationSpecificationMap(\Neighborhoods\Prefab\MapInterface $actorMap): FabricationSpecificationInterface
     {
         if ($this->actorMap !== null) {
             throw new \LogicException('actorMap has already been set');
         }
         
         $this->actorMap = $actorMap;
         
         return $this;
     }
}

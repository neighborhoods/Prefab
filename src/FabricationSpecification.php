<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class FabricationSpecification implements FabricationSpecificationInterface
{
    /** @var \Neighborhoods\Prefab\Actor\MapInterface */
    private $actorMap;

     public function getActorMap(): \Neighborhoods\Prefab\Actor\MapInterface
     {
         if ($this->actorMap === null) {
             throw new \LogicException('actorMap has not been set');
         }
         
         return $this->actorMap;
     }
     
     public function setActorMap(\Neighborhoods\Prefab\Actor\MapInterface $actorMap): FabricationSpecificationInterface
     {
         if ($this->actorMap !== null) {
             throw new \LogicException('actorMap has already been set');
         }
         
         $this->actorMap = $actorMap;
         
         return $this;
     }
}

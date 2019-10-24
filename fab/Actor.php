<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class Actor implements ActorInterface
{
    /** @var \Neighborhoods\Prefab\AnnotationProcessor\Map */
    private $annotationProcessorMap;

    /** @var string */
    private $actorKey;

    /** @var string */
    private $templatePath;

     public function getAnnotationProcessorMap(): \Neighborhoods\Prefab\AnnotationProcessor\Map
     {
         if ($this->annotationProcessorMap === null) {
             throw new \LogicException('annotationProcessorMap has not been set');
         }
         
         return $this->annotationProcessorMap;
     }
     
     public function setAnnotationProcessorMap(\Neighborhoods\Prefab\AnnotationProcessor\Map $annotationProcessorMap): ActorInterface
     {
         if ($this->annotationProcessorMap !== null) {
             throw new \LogicException('annotationProcessorMap has already been set');
         }
         
         $this->annotationProcessorMap = $annotationProcessorMap;
         
         return $this;
     }

     public function getActorKey(): string
     {
         if ($this->actorKey === null) {
             throw new \LogicException('actorKey has not been set');
         }
         
         return $this->actorKey;
     }
     
     public function setActorKey(string $actorKey): ActorInterface
     {
         if ($this->actorKey !== null) {
             throw new \LogicException('actorKey has already been set');
         }
         
         $this->actorKey = $actorKey;
         
         return $this;
     }

     public function getActorPath(): string
     {
         if ($this->templatePath === null) {
             throw new \LogicException('templatePath has not been set');
         }
         
         return $this->templatePath;
     }
     
     public function setActorPath(string $templatePath): ActorInterface
     {
         if ($this->templatePath !== null) {
             throw new \LogicException('templatePath has already been set');
         }
         
         $this->templatePath = $templatePath;
         
         return $this;
     }
}

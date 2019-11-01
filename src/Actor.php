<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class Actor implements ActorInterface
{
    /** @var \Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface */
    private $annotationProcessorRecordMap;

    /** @var string */
    private $actorKey;

    /** @var string */
    private $templatePath;

     public function getAnnotationProcessorRecordMap(): \Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface
     {
         if ($this->annotationProcessorRecordMap === null) {
             throw new \LogicException('annotationProcessorRecordMap has not been set');
         }
         
         return $this->annotationProcessorRecordMap;
     }
     
     public function setAnnotationProcessorRecordMap(\Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface $annotationProcessorRecordMap): ActorInterface
     {
         if ($this->annotationProcessorRecordMap !== null) {
             throw new \LogicException('annotationProcessorRecordMap has already been set');
         }
         
         $this->annotationProcessorRecordMap = $annotationProcessorRecordMap;
         
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

     public function getTemplatePath(): string
     {
         if ($this->templatePath === null) {
             throw new \LogicException('templatePath has not been set');
         }
         
         return $this->templatePath;
     }
     
     public function setTemplatePath(string $templatePath): ActorInterface
     {
         if ($this->templatePath !== null) {
             throw new \LogicException('templatePath has already been set');
         }
         
         $this->templatePath = $templatePath;
         
         return $this;
     }
}

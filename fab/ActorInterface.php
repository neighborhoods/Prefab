<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface ActorInterface
{
     public function getAnnotationProcessorRecordMap(): \Neighborhoods\Prefab\AnnotationProcessorRecord\Map;
     public function setAnnotationProcessorRecordMap(\Neighborhoods\Prefab\AnnotationProcessorRecord\Map $annotationProcessorRecordMap): ActorInterface;

     public function getActorKey(): string;
     public function setActorKey(string $actorKey): ActorInterface;

     public function getActorInterfacePath(): string;
     public function setActorInterfacePath(string $templatePath): ActorInterface;
}

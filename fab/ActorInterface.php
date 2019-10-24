<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface ActorInterface
{
     public function getAnnotationProcessorMap(): \Neighborhoods\Prefab\AnnotationProcessor\Map;
     public function setAnnotationProcessorMap(\Neighborhoods\Prefab\AnnotationProcessor\Map $annotationProcessorMap): ActorInterface;

     public function getActorKey(): string;
     public function setActorKey(string $actorKey): ActorInterface;

     public function getActorInterfacePath(): string;
     public function setActorInterfacePath(string $templatePath): ActorInterface;
}

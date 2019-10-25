<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface ActorInterface
{
     public function getAnnotationProcessorRecordMap(): \Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface;
     public function setAnnotationProcessorRecordMap(\Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface $annotationProcessorRecordMap): ActorInterface;

     public function getActorKey(): string;
     public function setActorKey(string $actorKey): ActorInterface;

     public function getTemplatePath(): string;
     public function setTemplatePath(string $templatePath): ActorInterface;
}

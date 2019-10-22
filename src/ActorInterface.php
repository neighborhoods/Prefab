<?php

namespace Neighborhoods\Prefab;

interface ActorInterface
{
    public function getAnnotationProcessorMap() : AnnotationProcessor;

    public function setAnnotationProcessorMap(AnnotationProcessor $annotationProcessorMap) : ActorInterface;

    public function getActorKey() : string;

    public function setActorKey(string $actorKey) : ActorInterface;

    public function getTemplatePath() : string;

    public function setTemplatePath(string $templatePath) : ActorInterface;
}

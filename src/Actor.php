<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class Actor implements ActorInterface
{
    protected $annotationProcessorMap;
    protected $actorKey;
    protected $templatePath;

    public function getAnnotationProcessorMap() : AnnotationProcessor
    {
        if ($this->annotationProcessorMap === null) {
            throw new \LogicException('Actor annotationProcessorMap has not been set.');
        }
        return $this->annotationProcessorMap;
    }

    public function setAnnotationProcessorMap(AnnotationProcessor $annotationProcessorMap) : ActorInterface
    {
        if ($this->annotationProcessorMap !== null) {
            throw new \LogicException('Actor annotationProcessorMap is already set.');
        }
        $this->annotationProcessorMap = $annotationProcessorMap;
        return $this;
    }

    public function getActorKey() : string
    {
        if ($this->actorKey === null) {
            throw new \LogicException('Actor actorKey has not been set.');
        }
        return $this->actorKey;
    }

    public function setActorKey(string $actorKey) : ActorInterface
    {
        if ($this->actorKey !== null) {
            throw new \LogicException('Actor actorKey is already set.');
        }
        $this->actorKey = $actorKey;
        return $this;
    }

    public function getTemplatePath() : string
    {
        if ($this->templatePath === null) {
            throw new \LogicException('Actor templatePath has not been set.');
        }
        return $this->templatePath;
    }

    public function setTemplatePath(string $templatePath) : ActorInterface
    {
        if ($this->templatePath !== null) {
            throw new \LogicException('Actor templatePath is already set.');
        }
        $this->templatePath = $templatePath;
        return $this;
    }
}

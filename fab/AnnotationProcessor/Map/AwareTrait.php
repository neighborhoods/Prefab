<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Map;

use Neighborhoods\Prefab\AnnotationProcessor\MapInterface;

trait AwareTrait
{
    protected $AnnotationProcessors;

    public function setAnnotationProcessorMap(MapInterface $AnnotationProcessors): self
    {
        if ($this->hasAnnotationProcessorMap()) {
            throw new \LogicException('AnnotationProcessors is already set.');
        }
        $this->AnnotationProcessors = $AnnotationProcessors;

        return $this;
    }

    protected function getAnnotationProcessorMap(): MapInterface
    {
        if (!$this->hasAnnotationProcessorMap()) {
            throw new \LogicException('AnnotationProcessors is not set.');
        }

        return $this->AnnotationProcessors;
    }

    protected function hasAnnotationProcessorMap(): bool
    {
        return isset($this->AnnotationProcessors);
    }

    protected function unsetAnnotationProcessorMap(): self
    {
        if (!$this->hasAnnotationProcessorMap()) {
            throw new \LogicException('AnnotationProcessors is not set.');
        }
        unset($this->AnnotationProcessors);

        return $this;
    }
}

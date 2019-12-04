<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\MapInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordStaticContextRecords;

    public function setAnnotationProcessorRecordStaticContextRecordMap(MapInterface $StaticContextRecords): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('Actors is already set.');
        }
        $this->AnnotationProcessorRecordStaticContextRecords = $StaticContextRecords;

        return $this;
    }

    protected function getAnnotationProcessorRecordStaticContextRecordMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }

        return $this->AnnotationProcessorRecordStaticContextRecords;
    }

    protected function hasActorMap(): bool
    {
        return isset($this->AnnotationProcessorRecordStaticContextRecords);
    }

    protected function unsetAnnotationProcessorRecordStaticContextRecordMap(): self
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }
        unset($this->AnnotationProcessorRecordStaticContextRecords);

        return $this;
    }
}

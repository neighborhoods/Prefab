<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecords;

    public function setAnnotationProcessorRecordMap(MapInterface $AnnotationProcessorRecords): self
    {
        if ($this->hasAnnotationProcessorRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecords is already set.');
        }
        $this->AnnotationProcessorRecords = $AnnotationProcessorRecords;

        return $this;
    }

    protected function getAnnotationProcessorRecordMap(): MapInterface
    {
        if (!$this->hasAnnotationProcessorRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecords is not set.');
        }

        return $this->AnnotationProcessorRecords;
    }

    protected function hasAnnotationProcessorRecordMap(): bool
    {
        return isset($this->AnnotationProcessorRecords);
    }

    protected function unsetAnnotationProcessorRecordMap(): self
    {
        if (!$this->hasAnnotationProcessorRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecords is not set.');
        }
        unset($this->AnnotationProcessorRecords);

        return $this;
    }
}

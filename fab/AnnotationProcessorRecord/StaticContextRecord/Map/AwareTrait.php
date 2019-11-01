<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\MapInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordStaticContextRecords;

    public function setAnnotationProcessorRecordStaticContextRecordMap(MapInterface $StaticContextRecords): self
    {
        if ($this->hasAnnotationProcessorRecordStaticContextRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecords is already set.');
        }
        $this->AnnotationProcessorRecordStaticContextRecords = $StaticContextRecords;

        return $this;
    }

    protected function getAnnotationProcessorRecordStaticContextRecordMap(): MapInterface
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecords is not set.');
        }

        return $this->AnnotationProcessorRecordStaticContextRecords;
    }

    protected function hasAnnotationProcessorRecordStaticContextRecordMap(): bool
    {
        return isset($this->AnnotationProcessorRecordStaticContextRecords);
    }

    protected function unsetAnnotationProcessorRecordStaticContextRecordMap(): self
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordMap()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecords is not set.');
        }
        unset($this->AnnotationProcessorRecordStaticContextRecords);

        return $this;
    }
}

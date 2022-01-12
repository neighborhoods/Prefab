<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecord;

    public function setAnnotationProcessorRecord(AnnotationProcessorRecordInterface $AnnotationProcessorRecord): self
    {
        if ($this->hasAnnotationProcessorRecord()) {
            throw new \LogicException('AnnotationProcessorRecord is already set.');
        }
        $this->AnnotationProcessorRecord = $AnnotationProcessorRecord;

        return $this;
    }

    protected function getAnnotationProcessorRecord(): AnnotationProcessorRecordInterface
    {
        if (!$this->hasAnnotationProcessorRecord()) {
            throw new \LogicException('AnnotationProcessorRecord is not set.');
        }

        return $this->AnnotationProcessorRecord;
    }

    protected function hasAnnotationProcessorRecord(): bool
    {
        return isset($this->AnnotationProcessorRecord);
    }

    protected function unsetAnnotationProcessorRecord(): self
    {
        if (!$this->hasAnnotationProcessorRecord()) {
            throw new \LogicException('AnnotationProcessorRecord is not set.');
        }
        unset($this->AnnotationProcessorRecord);

        return $this;
    }
}

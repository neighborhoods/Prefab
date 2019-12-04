<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecord;

    public function setAnnotationProcessorRecord(AnnotationProcessorRecordInterface $AnnotationProcessorRecord): self
    {
        if ($this->hasActor()) {
            throw new \LogicException('Actor is already set.');
        }
        $this->AnnotationProcessorRecord = $AnnotationProcessorRecord;

        return $this;
    }

    protected function getAnnotationProcessorRecord(): AnnotationProcessorRecordInterface
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }

        return $this->AnnotationProcessorRecord;
    }

    protected function hasActor(): bool
    {
        return isset($this->AnnotationProcessorRecord);
    }

    protected function unsetAnnotationProcessorRecord(): self
    {
        if (!$this->hasActor()) {
            throw new \LogicException('Actor is not set.');
        }
        unset($this->AnnotationProcessorRecord);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Builder;

use Neighborhoods\Prefab\AnnotationProcessorRecord\BuilderInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordBuilder;

    public function setAnnotationProcessorRecordBuilder(BuilderInterface $AnnotationProcessorRecordBuilder): self
    {
        if ($this->hasAnnotationProcessorRecordBuilder()) {
            throw new \LogicException('AnnotationProcessorRecordBuilder is already set.');
        }
        $this->AnnotationProcessorRecordBuilder = $AnnotationProcessorRecordBuilder;

        return $this;
    }

    protected function getAnnotationProcessorRecordBuilder(): BuilderInterface
    {
        if (!$this->hasAnnotationProcessorRecordBuilder()) {
            throw new \LogicException('AnnotationProcessorRecordBuilder is not set.');
        }

        return $this->AnnotationProcessorRecordBuilder;
    }

    protected function hasAnnotationProcessorRecordBuilder(): bool
    {
        return isset($this->AnnotationProcessorRecordBuilder);
    }

    protected function unsetAnnotationProcessorRecordBuilder(): self
    {
        if (!$this->hasAnnotationProcessorRecordBuilder()) {
            throw new \LogicException('AnnotationProcessorRecordBuilder is not set.');
        }
        unset($this->AnnotationProcessorRecordBuilder);

        return $this;
    }
}

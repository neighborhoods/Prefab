<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Builder\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Builder\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordBuilderFactory;

    public function setAnnotationProcessorRecordBuilderFactory(FactoryInterface $AnnotationProcessorRecordBuilderFactory): self
    {
        if ($this->hasAnnotationProcessorRecordBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordBuilderFactory is already set.');
        }
        $this->AnnotationProcessorRecordBuilderFactory = $AnnotationProcessorRecordBuilderFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordBuilderFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordBuilderFactory is not set.');
        }

        return $this->AnnotationProcessorRecordBuilderFactory;
    }

    protected function hasAnnotationProcessorRecordBuilderFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordBuilderFactory);
    }

    protected function unsetAnnotationProcessorRecordBuilderFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordBuilderFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordBuilderFactory);

        return $this;
    }
}

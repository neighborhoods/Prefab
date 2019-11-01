<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordStaticContextRecordFactory;

    public function setAnnotationProcessorRecordStaticContextRecordFactory(FactoryInterface $StaticContextRecordFactory): self
    {
        if ($this->hasAnnotationProcessorRecordStaticContextRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordFactory is already set.');
        }
        $this->AnnotationProcessorRecordStaticContextRecordFactory = $StaticContextRecordFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordStaticContextRecordFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordFactory is not set.');
        }

        return $this->AnnotationProcessorRecordStaticContextRecordFactory;
    }

    protected function hasAnnotationProcessorRecordStaticContextRecordFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordStaticContextRecordFactory);
    }

    protected function unsetAnnotationProcessorRecordStaticContextRecordFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordStaticContextRecordFactory);

        return $this;
    }
}

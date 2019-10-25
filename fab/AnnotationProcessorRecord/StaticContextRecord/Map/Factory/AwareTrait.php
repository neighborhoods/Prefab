<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordStaticContextRecordMapFactory;

    public function setAnnotationProcessorRecordStaticContextRecordMapFactory(FactoryInterface $StaticContextRecordMapFactory): self
    {
        if ($this->hasAnnotationProcessorRecordStaticContextRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordMapFactory is already set.');
        }
        $this->AnnotationProcessorRecordStaticContextRecordMapFactory = $StaticContextRecordMapFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordStaticContextRecordMapFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordMapFactory is not set.');
        }

        return $this->AnnotationProcessorRecordStaticContextRecordMapFactory;
    }

    protected function hasAnnotationProcessorRecordStaticContextRecordMapFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordStaticContextRecordMapFactory);
    }

    protected function unsetAnnotationProcessorRecordStaticContextRecordMapFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordStaticContextRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordStaticContextRecordMapFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordStaticContextRecordMapFactory);

        return $this;
    }
}

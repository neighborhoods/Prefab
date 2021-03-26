<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Map\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Map\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordMapFactory;

    public function setAnnotationProcessorRecordMapFactory(FactoryInterface $AnnotationProcessorRecordMapFactory): self
    {
        if ($this->hasAnnotationProcessorRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordMapFactory is already set.');
        }
        $this->AnnotationProcessorRecordMapFactory = $AnnotationProcessorRecordMapFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordMapFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordMapFactory is not set.');
        }

        return $this->AnnotationProcessorRecordMapFactory;
    }

    protected function hasAnnotationProcessorRecordMapFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordMapFactory);
    }

    protected function unsetAnnotationProcessorRecordMapFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordMapFactory()) {
            throw new \LogicException('AnnotationProcessorRecordMapFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordMapFactory);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordFactory;

    public function setAnnotationProcessorRecordFactory(FactoryInterface $AnnotationProcessorRecordFactory): self
    {
        if ($this->hasAnnotationProcessorRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordFactory is already set.');
        }
        $this->AnnotationProcessorRecordFactory = $AnnotationProcessorRecordFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordFactory is not set.');
        }

        return $this->AnnotationProcessorRecordFactory;
    }

    protected function hasAnnotationProcessorRecordFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordFactory);
    }

    protected function unsetAnnotationProcessorRecordFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordFactory()) {
            throw new \LogicException('AnnotationProcessorRecordFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordFactory);

        return $this;
    }
}

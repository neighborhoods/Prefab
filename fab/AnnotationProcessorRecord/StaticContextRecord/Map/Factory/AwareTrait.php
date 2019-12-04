<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordStaticContextRecordMapFactory;

    public function setAnnotationProcessorRecordStaticContextRecordMapFactory(FactoryInterface $StaticContextRecordMapFactory): self
    {
        if ($this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is already set.');
        }
        $this->AnnotationProcessorRecordStaticContextRecordMapFactory = $StaticContextRecordMapFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordStaticContextRecordMapFactory(): FactoryInterface
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }

        return $this->AnnotationProcessorRecordStaticContextRecordMapFactory;
    }

    protected function hasActorMapFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordStaticContextRecordMapFactory);
    }

    protected function unsetAnnotationProcessorRecordStaticContextRecordMapFactory(): self
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordStaticContextRecordMapFactory);

        return $this;
    }
}

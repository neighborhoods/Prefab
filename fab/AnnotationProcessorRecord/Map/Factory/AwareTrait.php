<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Map\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Map\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordMapFactory;

    public function setAnnotationProcessorRecordMapFactory(FactoryInterface $AnnotationProcessorRecordMapFactory): self
    {
        if ($this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is already set.');
        }
        $this->AnnotationProcessorRecordMapFactory = $AnnotationProcessorRecordMapFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordMapFactory(): FactoryInterface
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }

        return $this->AnnotationProcessorRecordMapFactory;
    }

    protected function hasActorMapFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordMapFactory);
    }

    protected function unsetAnnotationProcessorRecordMapFactory(): self
    {
        if (!$this->hasActorMapFactory()) {
            throw new \LogicException('ActorMapFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordMapFactory);

        return $this;
    }
}

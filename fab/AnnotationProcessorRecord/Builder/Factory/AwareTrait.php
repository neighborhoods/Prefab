<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Builder\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Builder\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordBuilderFactory;

    public function setAnnotationProcessorRecordBuilderFactory(FactoryInterface $AnnotationProcessorRecordBuilderFactory): self
    {
        if ($this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is already set.');
        }
        $this->AnnotationProcessorRecordBuilderFactory = $AnnotationProcessorRecordBuilderFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordBuilderFactory(): FactoryInterface
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }

        return $this->AnnotationProcessorRecordBuilderFactory;
    }

    protected function hasActorBuilderFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordBuilderFactory);
    }

    protected function unsetAnnotationProcessorRecordBuilderFactory(): self
    {
        if (!$this->hasActorBuilderFactory()) {
            throw new \LogicException('ActorBuilderFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordBuilderFactory);

        return $this;
    }
}

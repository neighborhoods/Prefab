<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Factory;

use Neighborhoods\Prefab\AnnotationProcessor\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorFactory;

    public function setAnnotationProcessorFactory(FactoryInterface $AnnotationProcessorFactory): self
    {
        if ($this->hasAnnotationProcessorFactory()) {
            throw new \LogicException('AnnotationProcessorFactory is already set.');
        }
        $this->AnnotationProcessorFactory = $AnnotationProcessorFactory;

        return $this;
    }

    protected function getAnnotationProcessorFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorFactory()) {
            throw new \LogicException('AnnotationProcessorFactory is not set.');
        }

        return $this->AnnotationProcessorFactory;
    }

    protected function hasAnnotationProcessorFactory(): bool
    {
        return isset($this->AnnotationProcessorFactory);
    }

    protected function unsetAnnotationProcessorFactory(): self
    {
        if (!$this->hasAnnotationProcessorFactory()) {
            throw new \LogicException('AnnotationProcessorFactory is not set.');
        }
        unset($this->AnnotationProcessorFactory);

        return $this;
    }
}

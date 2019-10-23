<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Prefab\AnnotationProcessorInterface;

trait AwareTrait
{
    protected $AnnotationProcessor;

    public function setAnnotationProcessor(AnnotationProcessorInterface $AnnotationProcessor): self
    {
        if ($this->hasAnnotationProcessor()) {
            throw new \LogicException('AnnotationProcessor is already set.');
        }
        $this->AnnotationProcessor = $AnnotationProcessor;

        return $this;
    }

    protected function getAnnotationProcessor(): AnnotationProcessorInterface
    {
        if (!$this->hasAnnotationProcessor()) {
            throw new \LogicException('AnnotationProcessor is not set.');
        }

        return $this->AnnotationProcessor;
    }

    protected function hasAnnotationProcessor(): bool
    {
        return isset($this->AnnotationProcessor);
    }

    protected function unsetAnnotationProcessor(): self
    {
        if (!$this->hasAnnotationProcessor()) {
            throw new \LogicException('AnnotationProcessor is not set.');
        }
        unset($this->AnnotationProcessor);

        return $this;
    }
}

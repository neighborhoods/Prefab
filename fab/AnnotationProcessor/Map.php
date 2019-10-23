<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Prefab\AnnotationProcessorInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param AnnotationProcessorInterface ...$AnnotationProcessors */
    public function __construct(array $AnnotationProcessors = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($AnnotationProcessors)) {
            $this->assertValidArrayType(...array_values($AnnotationProcessors));
        }

        parent::__construct($AnnotationProcessors, $flags);
    }

    public function offsetGet($index): AnnotationProcessorInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param AnnotationProcessorInterface $AnnotationProcessor */
    public function offsetSet($index, $AnnotationProcessor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($AnnotationProcessor));
    }

    /** @param AnnotationProcessorInterface $AnnotationProcessor */
    public function append($AnnotationProcessor)
    {
        $this->assertValidArrayItemType($AnnotationProcessor);
        parent::append($AnnotationProcessor);
    }

    public function current(): AnnotationProcessorInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(AnnotationProcessorInterface $AnnotationProcessor)
    {
        return $AnnotationProcessor;
    }

    protected function assertValidArrayType(AnnotationProcessorInterface ...$AnnotationProcessors): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    /** @param AnnotationProcessorInterface ...$AnnotationProcessors */
    public function hydrate(array $AnnotationProcessors): MapInterface
    {
        $this->__construct($AnnotationProcessors);

        return $this;
    }
}

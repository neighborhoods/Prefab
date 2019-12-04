<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param AnnotationProcessorRecordInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($Actors)) {
            $this->assertValidArrayType(...array_values($Actors));
        }

        parent::__construct($Actors, $flags);
    }

    public function offsetGet($index): AnnotationProcessorRecordInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param AnnotationProcessorRecordInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param AnnotationProcessorRecordInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): AnnotationProcessorRecordInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(AnnotationProcessorRecordInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(AnnotationProcessorRecordInterface ...$Actors): MapInterface
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

    /** @param AnnotationProcessorRecordInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}

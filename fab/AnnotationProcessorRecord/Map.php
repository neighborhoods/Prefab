<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param AnnotationProcessorRecordInterface ...$AnnotationProcessorRecords */
    public function __construct(array $AnnotationProcessorRecords = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($AnnotationProcessorRecords)) {
            $this->assertValidArrayType(...array_values($AnnotationProcessorRecords));
        }

        parent::__construct($AnnotationProcessorRecords, $flags);
    }

    public function offsetGet($index): AnnotationProcessorRecordInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param AnnotationProcessorRecordInterface $AnnotationProcessorRecord */
    public function offsetSet($index, $AnnotationProcessorRecord)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($AnnotationProcessorRecord));
    }

    /** @param AnnotationProcessorRecordInterface $AnnotationProcessorRecord */
    public function append($AnnotationProcessorRecord)
    {
        $this->assertValidArrayItemType($AnnotationProcessorRecord);
        parent::append($AnnotationProcessorRecord);
    }

    public function current(): AnnotationProcessorRecordInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(AnnotationProcessorRecordInterface $AnnotationProcessorRecord)
    {
        return $AnnotationProcessorRecord;
    }

    protected function assertValidArrayType(AnnotationProcessorRecordInterface ...$AnnotationProcessorRecords): MapInterface
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

    /** @param AnnotationProcessorRecordInterface ...$AnnotationProcessorRecords */
    public function hydrate(array $AnnotationProcessorRecords): MapInterface
    {
        $this->__construct($AnnotationProcessorRecords);

        return $this;
    }
}

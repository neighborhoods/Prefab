<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param StaticContextRecordInterface ...$StaticContextRecords */
    public function __construct(array $StaticContextRecords = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($StaticContextRecords)) {
            $this->assertValidArrayType(...array_values($StaticContextRecords));
        }

        parent::__construct($StaticContextRecords, $flags);
    }

    public function offsetGet($index): StaticContextRecordInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param StaticContextRecordInterface $StaticContextRecord */
    public function offsetSet($index, $StaticContextRecord)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($StaticContextRecord));
    }

    /** @param StaticContextRecordInterface $StaticContextRecord */
    public function append($StaticContextRecord)
    {
        $this->assertValidArrayItemType($StaticContextRecord);
        parent::append($StaticContextRecord);
    }

    public function current(): StaticContextRecordInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(StaticContextRecordInterface $StaticContextRecord)
    {
        return $StaticContextRecord;
    }

    protected function assertValidArrayType(StaticContextRecordInterface ...$StaticContextRecords): MapInterface
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

    /** @param StaticContextRecordInterface ...$StaticContextRecords */
    public function hydrate(array $StaticContextRecords): MapInterface
    {
        $this->__construct($StaticContextRecords);

        return $this;
    }
}

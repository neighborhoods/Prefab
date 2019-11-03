<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param StaticContextRecordInterface ...$StaticContextRecords */
    public function __construct(array $StaticContextRecords = [], int $flags = 0);

    public function offsetGet($index): StaticContextRecordInterface;

    /** @param StaticContextRecordInterface $StaticContextRecord */
    public function offsetSet($index, $StaticContextRecord);

    /** @param StaticContextRecordInterface $StaticContextRecord */
    public function append($StaticContextRecord);

    public function current(): StaticContextRecordInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param StaticContextRecordInterface ...$StaticContextRecords */
    public function hydrate(array $StaticContextRecords): MapInterface;
}

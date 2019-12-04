<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param AnnotationProcessorRecordInterface ...$AnnotationProcessorRecords */
    public function __construct(array $AnnotationProcessorRecords = [], int $flags = 0);

    public function offsetGet($index): AnnotationProcessorRecordInterface;

    /** @param AnnotationProcessorRecordInterface $AnnotationProcessorRecord */
    public function offsetSet($index, $AnnotationProcessorRecord);

    /** @param AnnotationProcessorRecordInterface $AnnotationProcessorRecord */
    public function append($AnnotationProcessorRecord);

    public function current(): AnnotationProcessorRecordInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param AnnotationProcessorRecordInterface ...$AnnotationProcessorRecords */
    public function hydrate(array $AnnotationProcessorRecords): MapInterface;
}

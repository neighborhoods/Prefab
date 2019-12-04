<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param AnnotationProcessorRecordInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): AnnotationProcessorRecordInterface;

    /** @param AnnotationProcessorRecordInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param AnnotationProcessorRecordInterface $Actor */
    public function append($Actor);

    public function current(): AnnotationProcessorRecordInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param AnnotationProcessorRecordInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

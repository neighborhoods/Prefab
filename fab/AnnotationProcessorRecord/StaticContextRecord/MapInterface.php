<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param StaticContextRecordInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): StaticContextRecordInterface;

    /** @param StaticContextRecordInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param StaticContextRecordInterface $Actor */
    public function append($Actor);

    public function current(): StaticContextRecordInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param StaticContextRecordInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

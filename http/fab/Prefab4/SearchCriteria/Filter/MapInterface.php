<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Filter;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param FilterInterface ...$filters */
    public function __construct(array $filters = array(), int $flags = 0);

    public function offsetGet($index): FilterInterface;

    /** @param FilterInterface $filter */
    public function offsetSet($index, $filter);

    /** @param FilterInterface $filter */
    public function append($filter);

    public function current(): FilterInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}

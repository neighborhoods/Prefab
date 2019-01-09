<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Visitor;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\VisitorInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param VisitorInterface ...$visitors */
    public function __construct(array $visitors = array(), int $flags = 0);

    public function offsetGet($index): VisitorInterface;

    /** @param VisitorInterface $visitor */
    public function offsetSet($index, $visitor);

    /** @param VisitorInterface $visitor */
    public function append($visitor);

    public function current(): VisitorInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}

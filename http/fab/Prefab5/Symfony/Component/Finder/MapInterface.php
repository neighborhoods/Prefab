<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Symfony\Component\Finder;

use Symfony\Component\Finder\Finder;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param Finder ...$finders */
    public function __construct(array $finders = array(), int $flags = 0);

    public function offsetGet($index): Finder;

    /** @param Finder $finder */
    public function offsetSet($index, $finder);

    /** @param Finder $finder */
    public function append($finder);

    public function current(): Finder;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}

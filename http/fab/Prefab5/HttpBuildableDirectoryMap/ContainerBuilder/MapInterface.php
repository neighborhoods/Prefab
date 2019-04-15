<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilderInterface;

/** @codeCoverageIgnore */
interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ContainerBuilderInterface ...$containerbuilders */
    public function __construct(array $containerbuilders = [], int $flags = 0);

    public function offsetGet($index) : ContainerBuilderInterface;

    /** @param ContainerBuilderInterface $containerbuilder */
    public function offsetSet($index, $containerbuilder);

    /** @param ContainerBuilderInterface $containerbuilder */
    public function append($containerbuilder);

    public function current() : ContainerBuilderInterface;

    public function getArrayCopy() : MapInterface;

    public function toArray() : array;

    public function hydrate(array $array) : MapInterface;
}

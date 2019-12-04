<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param DaoPropertyInterface ...$DaoPropertys */
    public function __construct(array $DaoPropertys = [], int $flags = 0);

    public function offsetGet($index): DaoPropertyInterface;

    /** @param DaoPropertyInterface $DaoProperty */
    public function offsetSet($index, $DaoProperty);

    /** @param DaoPropertyInterface $DaoProperty */
    public function append($DaoProperty);

    public function current(): DaoPropertyInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param DaoPropertyInterface ...$DaoPropertys */
    public function hydrate(array $DaoPropertys): MapInterface;
}

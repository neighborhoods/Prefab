<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param DaoPropertyInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): DaoPropertyInterface;

    /** @param DaoPropertyInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param DaoPropertyInterface $Actor */
    public function append($Actor);

    public function current(): DaoPropertyInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param DaoPropertyInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

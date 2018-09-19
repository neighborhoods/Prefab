<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\MapInterface;

/** @codeCoverageIgnore */
interface Template extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param REPLACE_DAO_NAMEInterface ...$REPLACE_DAO_VARs */
    public function __construct(array $REPLACE_DAO_VARs = array(), int $flags = 0);

    public function offsetGet($index): REPLACE_DAO_NAMEInterface;

    /** @param REPLACE_DAO_NAMEInterface $REPLACE_DAO_VAR */
    public function offsetSet($index, $REPLACE_DAO_VAR);

    /** @param REPLACE_DAO_NAMEInterface $REPLACE_DAO_VAR */
    public function append($REPLACE_DAO_VAR);

    public function current(): REPLACE_DAO_NAMEInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}

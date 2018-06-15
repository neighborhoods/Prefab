<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip;

/** @codeCoverageIgnore */
interface UpdateArrayInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param UpdateInterface ...$v1MVBlipUpdates */
    public function __construct(array $v1MVBlipUpdates = array(), int $flags = 0);

    public function offsetGet($index): UpdateInterface;

    /** @param UpdateInterface $v1MVBlipUpdate */
    public function offsetSet($index, $v1MVBlipUpdate);

    /** @param UpdateInterface $v1MVBlipUpdate */
    public function append($v1MVBlipUpdate);

    public function current(): UpdateInterface;

    public function getArrayCopy(): UpdateArrayInterface;

    public function toArray(): array;

    public function hydrate(array $array): UpdateArrayInterface;
}

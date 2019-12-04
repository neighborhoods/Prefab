<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ConstantInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): ConstantInterface;

    /** @param ConstantInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param ConstantInterface $Actor */
    public function append($Actor);

    public function current(): ConstantInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param ConstantInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ConstantInterface ...$Constants */
    public function __construct(array $Constants = [], int $flags = 0);

    public function offsetGet($index): ConstantInterface;

    /** @param ConstantInterface $Constant */
    public function offsetSet($index, $Constant);

    /** @param ConstantInterface $Constant */
    public function append($Constant);

    public function current(): ConstantInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param ConstantInterface ...$Constants */
    public function hydrate(array $Constants): MapInterface;
}

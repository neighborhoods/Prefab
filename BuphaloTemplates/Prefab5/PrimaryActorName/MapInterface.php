<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param PrimaryActorNameInterface ...$PrimaryActorNames */
    public function __construct(array $PrimaryActorNames = [], int $flags = 0);

    public function offsetGet($index): PrimaryActorNameInterface;

    /** @param PrimaryActorNameInterface $PrimaryActorName */
    public function offsetSet($index, $PrimaryActorName);

    /** @param PrimaryActorNameInterface $PrimaryActorName */
    public function append($PrimaryActorName);

    public function current(): PrimaryActorNameInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param PrimaryActorNameInterface ...$PrimaryActorNames */
    public function hydrate(array $PrimaryActorNames): MapInterface;
}

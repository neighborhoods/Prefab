<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param PrimaryActorNameInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): PrimaryActorNameInterface;

    /** @param PrimaryActorNameInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param PrimaryActorNameInterface $Actor */
    public function append($Actor);

    public function current(): PrimaryActorNameInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param PrimaryActorNameInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

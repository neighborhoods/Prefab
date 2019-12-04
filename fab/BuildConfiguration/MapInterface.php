<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param BuildConfigurationInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): BuildConfigurationInterface;

    /** @param BuildConfigurationInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param BuildConfigurationInterface $Actor */
    public function append($Actor);

    public function current(): BuildConfigurationInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param BuildConfigurationInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

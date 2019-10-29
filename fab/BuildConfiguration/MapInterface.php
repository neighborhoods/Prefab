<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param BuildConfigurationInterface ...$BuildConfigurations */
    public function __construct(array $BuildConfigurations = [], int $flags = 0);

    public function offsetGet($index): BuildConfigurationInterface;

    /** @param BuildConfigurationInterface $BuildConfiguration */
    public function offsetSet($index, $BuildConfiguration);

    /** @param BuildConfigurationInterface $BuildConfiguration */
    public function append($BuildConfiguration);

    public function current(): BuildConfigurationInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param BuildConfigurationInterface ...$BuildConfigurations */
    public function hydrate(array $BuildConfigurations): MapInterface;
}

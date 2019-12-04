<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param BuildConfigurationInterface ...$BuildConfigurations */
    public function __construct(array $BuildConfigurations = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($BuildConfigurations)) {
            $this->assertValidArrayType(...array_values($BuildConfigurations));
        }

        parent::__construct($BuildConfigurations, $flags);
    }

    public function offsetGet($index): BuildConfigurationInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param BuildConfigurationInterface $BuildConfiguration */
    public function offsetSet($index, $BuildConfiguration)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($BuildConfiguration));
    }

    /** @param BuildConfigurationInterface $BuildConfiguration */
    public function append($BuildConfiguration)
    {
        $this->assertValidArrayItemType($BuildConfiguration);
        parent::append($BuildConfiguration);
    }

    public function current(): BuildConfigurationInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(BuildConfigurationInterface $BuildConfiguration)
    {
        return $BuildConfiguration;
    }

    protected function assertValidArrayType(BuildConfigurationInterface ...$BuildConfigurations): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    /** @param BuildConfigurationInterface ...$BuildConfigurations */
    public function hydrate(array $BuildConfigurations): MapInterface
    {
        $this->__construct($BuildConfigurations);

        return $this;
    }
}

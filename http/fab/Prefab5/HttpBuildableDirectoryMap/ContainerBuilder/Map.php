<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\HttpBuildableDirectoryMap\ContainerBuilderInterface;

/** @codeCoverageIgnore */
class Map extends \ArrayIterator implements MapInterface
{
    /** @param ContainerBuilderInterface ...$containerbuilders */
    public function __construct(array $containerbuilders = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($containerbuilders)) {
            $this->assertValidArrayType(...array_values($containerbuilders));
        }

        parent::__construct($containerbuilders, $flags);
    }

    public function offsetGet($index) : ContainerBuilderInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ContainerBuilderInterface $containerbuilder */
    public function offsetSet($index, $containerbuilder)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($containerbuilder));
    }

    /** @param ContainerBuilderInterface $containerbuilder */
    public function append($containerbuilder)
    {
        $this->assertValidArrayItemType($containerbuilder);
        parent::append($containerbuilder);
    }

    public function current() : ContainerBuilderInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ContainerBuilderInterface $containerbuilder)
    {
        return $containerbuilder;
    }

    protected function assertValidArrayType(ContainerBuilderInterface ...$containerbuilders) : MapInterface
    {
        return $this;
    }

    public function getArrayCopy() : MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray() : array
    {
        return (array)$this;
    }

    public function hydrate(array $array) : MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}

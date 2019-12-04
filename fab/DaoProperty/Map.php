<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param DaoPropertyInterface ...$DaoPropertys */
    public function __construct(array $DaoPropertys = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($DaoPropertys)) {
            $this->assertValidArrayType(...array_values($DaoPropertys));
        }

        parent::__construct($DaoPropertys, $flags);
    }

    public function offsetGet($index): DaoPropertyInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param DaoPropertyInterface $DaoProperty */
    public function offsetSet($index, $DaoProperty)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($DaoProperty));
    }

    /** @param DaoPropertyInterface $DaoProperty */
    public function append($DaoProperty)
    {
        $this->assertValidArrayItemType($DaoProperty);
        parent::append($DaoProperty);
    }

    public function current(): DaoPropertyInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(DaoPropertyInterface $DaoProperty)
    {
        return $DaoProperty;
    }

    protected function assertValidArrayType(DaoPropertyInterface ...$DaoPropertys): MapInterface
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

    /** @param DaoPropertyInterface ...$DaoPropertys */
    public function hydrate(array $DaoPropertys): MapInterface
    {
        $this->__construct($DaoPropertys);

        return $this;
    }
}

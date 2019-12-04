<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param DaoPropertyInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($Actors)) {
            $this->assertValidArrayType(...array_values($Actors));
        }

        parent::__construct($Actors, $flags);
    }

    public function offsetGet($index): DaoPropertyInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param DaoPropertyInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param DaoPropertyInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): DaoPropertyInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(DaoPropertyInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(DaoPropertyInterface ...$Actors): MapInterface
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

    /** @param DaoPropertyInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}

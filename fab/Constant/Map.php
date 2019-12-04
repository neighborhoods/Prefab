<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param ConstantInterface ...$Actors */
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

    public function offsetGet($index): ConstantInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param ConstantInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param ConstantInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): ConstantInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(ConstantInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(ConstantInterface ...$Actors): MapInterface
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

    /** @param ConstantInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}

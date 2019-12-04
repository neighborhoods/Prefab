<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param FabricationSpecificationInterface ...$Actors */
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

    public function offsetGet($index): FabricationSpecificationInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param FabricationSpecificationInterface $Actor */
    public function offsetSet($index, $Actor)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($Actor));
    }

    /** @param FabricationSpecificationInterface $Actor */
    public function append($Actor)
    {
        $this->assertValidArrayItemType($Actor);
        parent::append($Actor);
    }

    public function current(): FabricationSpecificationInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(FabricationSpecificationInterface $Actor)
    {
        return $Actor;
    }

    protected function assertValidArrayType(FabricationSpecificationInterface ...$Actors): MapInterface
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

    /** @param FabricationSpecificationInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface
    {
        $this->__construct($Actors);

        return $this;
    }
}

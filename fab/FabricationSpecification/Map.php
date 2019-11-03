<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Map extends \ArrayIterator implements MapInterface
{
    /** @param FabricationSpecificationInterface ...$FabricationSpecifications */
    public function __construct(array $FabricationSpecifications = [], int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($FabricationSpecifications)) {
            $this->assertValidArrayType(...array_values($FabricationSpecifications));
        }

        parent::__construct($FabricationSpecifications, $flags);
    }

    public function offsetGet($index): FabricationSpecificationInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param FabricationSpecificationInterface $FabricationSpecification */
    public function offsetSet($index, $FabricationSpecification)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($FabricationSpecification));
    }

    /** @param FabricationSpecificationInterface $FabricationSpecification */
    public function append($FabricationSpecification)
    {
        $this->assertValidArrayItemType($FabricationSpecification);
        parent::append($FabricationSpecification);
    }

    public function current(): FabricationSpecificationInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(FabricationSpecificationInterface $FabricationSpecification)
    {
        return $FabricationSpecification;
    }

    protected function assertValidArrayType(FabricationSpecificationInterface ...$FabricationSpecifications): MapInterface
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

    /** @param FabricationSpecificationInterface ...$FabricationSpecifications */
    public function hydrate(array $FabricationSpecifications): MapInterface
    {
        $this->__construct($FabricationSpecifications);

        return $this;
    }
}

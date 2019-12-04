<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param FabricationSpecificationInterface ...$FabricationSpecifications */
    public function __construct(array $FabricationSpecifications = [], int $flags = 0);

    public function offsetGet($index): FabricationSpecificationInterface;

    /** @param FabricationSpecificationInterface $FabricationSpecification */
    public function offsetSet($index, $FabricationSpecification);

    /** @param FabricationSpecificationInterface $FabricationSpecification */
    public function append($FabricationSpecification);

    public function current(): FabricationSpecificationInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param FabricationSpecificationInterface ...$FabricationSpecifications */
    public function hydrate(array $FabricationSpecifications): MapInterface;
}

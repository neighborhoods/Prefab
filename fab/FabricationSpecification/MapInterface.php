<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface MapInterface extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param FabricationSpecificationInterface ...$Actors */
    public function __construct(array $Actors = [], int $flags = 0);

    public function offsetGet($index): FabricationSpecificationInterface;

    /** @param FabricationSpecificationInterface $Actor */
    public function offsetSet($index, $Actor);

    /** @param FabricationSpecificationInterface $Actor */
    public function append($Actor);

    public function current(): FabricationSpecificationInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    /** @param FabricationSpecificationInterface ...$Actors */
    public function hydrate(array $Actors): MapInterface;
}

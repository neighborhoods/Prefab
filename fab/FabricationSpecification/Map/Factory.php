<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Map;

use Neighborhoods\Prefab\FabricationSpecification\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getFabricationSpecificationMap()->getArrayCopy();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Map;

use Neighborhoods\Prefab\FabricationSpecification\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

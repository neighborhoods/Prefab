<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface FactoryInterface
{
    public function create(): FabricationSpecificationInterface;
}

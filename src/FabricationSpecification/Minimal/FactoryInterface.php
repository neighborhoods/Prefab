<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface FactoryInterface
{
    public function create(): FabricationSpecificationInterface;
}

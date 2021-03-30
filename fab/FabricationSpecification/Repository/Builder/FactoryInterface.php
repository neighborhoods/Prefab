<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Repository\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

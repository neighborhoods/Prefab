<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Builder;

use Neighborhoods\Prefab\FabricationSpecification\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

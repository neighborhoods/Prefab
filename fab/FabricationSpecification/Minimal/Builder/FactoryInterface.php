<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

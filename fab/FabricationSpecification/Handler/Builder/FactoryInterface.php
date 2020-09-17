<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Handler\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

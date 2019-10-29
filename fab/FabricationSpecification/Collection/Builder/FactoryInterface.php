<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Collection\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

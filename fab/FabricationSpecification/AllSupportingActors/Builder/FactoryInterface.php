<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

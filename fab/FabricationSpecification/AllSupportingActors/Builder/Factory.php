<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder;

use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationAllSupportingActorsBuilder();
    }
}

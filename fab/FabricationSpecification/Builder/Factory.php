<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Builder;

use Neighborhoods\Prefab\FabricationSpecification\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationBuilder();
    }
}

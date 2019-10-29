<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Minimal\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationMinimalBuilder();
    }
}

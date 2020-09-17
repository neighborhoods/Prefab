<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Handler\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Handler\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationHandlerBuilder();
    }
}

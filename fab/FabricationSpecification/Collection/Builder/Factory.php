<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Collection\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Collection\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationCollectionBuilder();
    }
}

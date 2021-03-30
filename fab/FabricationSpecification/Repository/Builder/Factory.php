<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository\Builder;

use Neighborhoods\Prefab\FabricationSpecification\Repository\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getFabricationSpecificationRepositoryBuilder();
    }
}

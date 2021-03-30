<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Repository;

use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): FabricationSpecificationInterface
    {
        return clone $this->getFabricationSpecificationRepository();
    }
}

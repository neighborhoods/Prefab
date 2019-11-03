<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer;

use Neighborhoods\Prefab\FabricationSpecification\WriterInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): WriterInterface
    {
        return clone $this->getFabricationSpecificationWriter();
    }
}

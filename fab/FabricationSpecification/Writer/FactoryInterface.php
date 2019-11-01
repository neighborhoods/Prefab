<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Writer;

use Neighborhoods\Prefab\FabricationSpecification\WriterInterface;

interface FactoryInterface
{
    public function create(): WriterInterface;
}

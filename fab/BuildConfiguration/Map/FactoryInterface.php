<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Map;

use Neighborhoods\Prefab\BuildConfiguration\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

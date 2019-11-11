<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map;

use Neighborhoods\Prefab\Constant\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

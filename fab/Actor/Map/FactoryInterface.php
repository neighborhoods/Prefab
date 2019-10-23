<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

use Neighborhoods\Prefab\Actor\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

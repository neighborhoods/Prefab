<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Map;

use Neighborhoods\Prefab\DaoProperty\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

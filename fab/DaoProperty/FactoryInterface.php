<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

interface FactoryInterface
{
    public function create(): DaoPropertyInterface;
}

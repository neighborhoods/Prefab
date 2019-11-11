<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

interface FactoryInterface
{
    public function create(): ConstantInterface;
}

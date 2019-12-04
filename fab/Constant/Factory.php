<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant;

use Neighborhoods\Prefab\ConstantInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): ConstantInterface
    {
        return clone $this->getConstant();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Constant\Map;

use Neighborhoods\Prefab\Constant\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getConstantMap()->getArrayCopy();
    }
}

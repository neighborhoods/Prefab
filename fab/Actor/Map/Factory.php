<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

use Neighborhoods\Prefab\Actor\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getActorMap()->getArrayCopy();
    }
}

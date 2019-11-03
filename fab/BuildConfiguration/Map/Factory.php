<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Map;

use Neighborhoods\Prefab\BuildConfiguration\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getBuildConfigurationMap()->getArrayCopy();
    }
}

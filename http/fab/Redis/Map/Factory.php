<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Map;

use Neighborhoods\PrefabExamplesFunction41\Redis\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getRedisMap()->getArrayCopy();
    }
}

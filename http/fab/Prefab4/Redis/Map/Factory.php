<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Redis\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getRedisMap()->getArrayCopy();
    }
}

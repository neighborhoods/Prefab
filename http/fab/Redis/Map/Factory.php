<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getRedisMap()->getArrayCopy();
    }
}

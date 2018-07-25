<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Map;

use neighborhoods\~~PROJECT NAME~~\Redis\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getRedisMap()->getArrayCopy();
    }
}

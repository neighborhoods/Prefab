<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Map;

use neighborhoods\~~PROJECT NAME~~\Redis\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

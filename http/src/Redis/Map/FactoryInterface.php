<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis\Map;

use Neighborhoods\~\Redis\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

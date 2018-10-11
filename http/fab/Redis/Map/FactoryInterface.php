<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Map;

use Neighborhoods\PrefabExamplesFunction41\Redis\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Map;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

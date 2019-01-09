<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

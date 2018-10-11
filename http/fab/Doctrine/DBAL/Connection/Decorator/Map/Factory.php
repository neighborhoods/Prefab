<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\Map;

use Neighborhoods\PrefabExamplesFunction41\Doctrine\DBAL\Connection\Decorator\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getDoctrineDBALConnectionDecoratorMap()->getArrayCopy();
    }
}

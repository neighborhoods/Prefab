<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorArrayInterface
    {
        return $this->getDoctrineDBALConnectionDecoratorArray()->getArrayCopy();
    }
}

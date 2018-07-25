<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorArrayInterface
    {
        return $this->getDoctrineDBALConnectionDecoratorArray()->getArrayCopy();
    }
}

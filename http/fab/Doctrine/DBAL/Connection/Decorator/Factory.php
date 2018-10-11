<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DecoratorInterface
    {
        return clone $this->getDoctrineDBALConnectionDecorator();
    }
}

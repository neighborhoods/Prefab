<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorInterface;
}

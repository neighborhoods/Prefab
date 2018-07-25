<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\~~PROJECT NAME~~\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorArrayInterface;
}

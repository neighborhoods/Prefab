<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorArrayInterface;
}

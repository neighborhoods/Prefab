<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorInterface;
}
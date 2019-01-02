<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): DecoratorInterface;
}

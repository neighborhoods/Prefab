<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\PDO\Builder;

use Neighborhoods\Radar\PDO\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}
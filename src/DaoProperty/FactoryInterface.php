<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : DaoPropertyInterface;
}

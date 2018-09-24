<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Handler\Generator;

use Neighborhoods\Prefab\Actor\Handler\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

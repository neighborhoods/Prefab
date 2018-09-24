<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\FactoryInterface\Generator;

use Neighborhoods\Prefab\Actor\FactoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

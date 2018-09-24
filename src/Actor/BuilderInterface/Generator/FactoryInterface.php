<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\BuilderInterface\Generator;

use Neighborhoods\Prefab\Actor\BuilderInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

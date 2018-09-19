<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuilderInterface\Generator;

use Neighborhoods\Prefab\BuilderInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

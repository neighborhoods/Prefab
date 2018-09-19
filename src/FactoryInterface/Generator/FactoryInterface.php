<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Generator;

use Neighborhoods\Prefab\FactoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

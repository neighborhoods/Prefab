<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\MapInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): GeneratorInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilder\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

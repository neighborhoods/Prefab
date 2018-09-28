<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Builder\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): GeneratorInterface;
}

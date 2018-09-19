<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Builder\Generator;

use Neighborhoods\Prefab\Builder\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

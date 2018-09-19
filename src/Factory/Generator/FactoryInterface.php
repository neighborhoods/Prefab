<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Generator;

use Neighborhoods\Prefab\Factory\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

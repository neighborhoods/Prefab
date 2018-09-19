<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Handler\Generator;

use Neighborhoods\Prefab\Handler\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

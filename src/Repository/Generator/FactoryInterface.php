<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Repository\Generator;

use Neighborhoods\Prefab\Repository\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

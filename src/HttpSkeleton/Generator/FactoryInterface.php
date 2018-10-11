<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton\Generator;

use Neighborhoods\Prefab\HttpSkeleton\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

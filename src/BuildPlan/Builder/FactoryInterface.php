<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan\Builder;

use Neighborhoods\Prefab\BuildPlan\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan;

use Neighborhoods\Prefab\BuildPlanInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuildPlanInterface;
}

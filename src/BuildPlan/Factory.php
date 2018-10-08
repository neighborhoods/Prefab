<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan;

use Neighborhoods\Prefab\BuildPlanInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuildPlanInterface
    {
        return clone $this->getBuildPlan();
    }
}

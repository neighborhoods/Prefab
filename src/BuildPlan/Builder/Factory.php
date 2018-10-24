<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan\Builder;

use Neighborhoods\Prefab\BuildPlan\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getBuildPlanBuilder();
    }
}

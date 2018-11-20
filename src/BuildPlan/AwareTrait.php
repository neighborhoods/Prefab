<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan;

use Neighborhoods\Prefab\BuildPlanInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildPlan;

    public function setBuildPlan(BuildPlanInterface $buildPlan) : self
    {
        if ($this->hasBuildPlan()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlan is already set.');
        }
        $this->NeighborhoodsPrefabBuildPlan = $buildPlan;

        return $this;
    }

    protected function getBuildPlan() : BuildPlanInterface
    {
        if (!$this->hasBuildPlan()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlan is not set.');
        }

        return $this->NeighborhoodsPrefabBuildPlan;
    }

    protected function hasBuildPlan() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildPlan);
    }

    protected function unsetBuildPlan() : self
    {
        if (!$this->hasBuildPlan()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlan is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildPlan);

        return $this;
    }
}

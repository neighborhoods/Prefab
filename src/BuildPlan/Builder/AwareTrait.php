<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan\Builder;

use Neighborhoods\Prefab\BuildPlan\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildPlanBuilder;

    public function setBuildPlanBuilder(BuilderInterface $buildPlanBuilder) : self
    {
        if ($this->hasBuildPlanBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilder is already set.');
        }
        $this->NeighborhoodsPrefabBuildPlanBuilder = $buildPlanBuilder;

        return $this;
    }

    protected function getBuildPlanBuilder() : BuilderInterface
    {
        if (!$this->hasBuildPlanBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabBuildPlanBuilder;
    }

    protected function hasBuildPlanBuilder() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildPlanBuilder);
    }

    protected function unsetBuildPlanBuilder() : self
    {
        if (!$this->hasBuildPlanBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildPlanBuilder);

        return $this;
    }
}

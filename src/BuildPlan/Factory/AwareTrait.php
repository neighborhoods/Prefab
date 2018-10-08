<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan\Factory;

use Neighborhoods\Prefab\BuildPlan\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildPlanFactory;

    public function setBuildPlanFactory(FactoryInterface $buildPlanFactory) : self
    {
        if ($this->hasBuildPlanFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuildPlanFactory = $buildPlanFactory;

        return $this;
    }

    protected function getBuildPlanFactory() : FactoryInterface
    {
        if (!$this->hasBuildPlanFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuildPlanFactory;
    }

    protected function hasBuildPlanFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildPlanFactory);
    }

    protected function unsetBuildPlanFactory() : self
    {
        if (!$this->hasBuildPlanFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildPlanFactory);

        return $this;
    }
}

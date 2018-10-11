<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan\Builder\Factory;

use Neighborhoods\Prefab\BuildPlan\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildPlanBuilderFactory;

    public function setBuildPlanBuilderFactory(FactoryInterface $buildPlanBuilderFactory) : self
    {
        if ($this->hasBuildPlanBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilderFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuildPlanBuilderFactory = $buildPlanBuilderFactory;

        return $this;
    }

    protected function getBuildPlanBuilderFactory() : FactoryInterface
    {
        if (!$this->hasBuildPlanBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilderFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuildPlanBuilderFactory;
    }

    protected function hasBuildPlanBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildPlanBuilderFactory);
    }

    protected function unsetBuildPlanBuilderFactory() : self
    {
        if (!$this->hasBuildPlanBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildPlanBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildPlanBuilderFactory);

        return $this;
    }
}

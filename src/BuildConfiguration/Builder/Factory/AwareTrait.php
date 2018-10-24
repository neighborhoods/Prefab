<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Builder\Factory;

use Neighborhoods\Prefab\BuildConfiguration\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildConfigurationBuilderFactory;

    public function setBuildConfigurationBuilderFactory(FactoryInterface $buildConfigurationBuilderFactory) : self
    {
        if ($this->hasBuildConfigurationBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilderFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuildConfigurationBuilderFactory = $buildConfigurationBuilderFactory;

        return $this;
    }

    protected function getBuildConfigurationBuilderFactory() : FactoryInterface
    {
        if (!$this->hasBuildConfigurationBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilderFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuildConfigurationBuilderFactory;
    }

    protected function hasBuildConfigurationBuilderFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildConfigurationBuilderFactory);
    }

    protected function unsetBuildConfigurationBuilderFactory() : self
    {
        if (!$this->hasBuildConfigurationBuilderFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildConfigurationBuilderFactory);

        return $this;
    }
}

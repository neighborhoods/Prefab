<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Factory;

use Neighborhoods\Prefab\BuildConfiguration\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildConfigurationFactory;

    public function setBuildConfigurationFactory(FactoryInterface $buildConfigurationFactory) : self
    {
        if ($this->hasBuildConfigurationFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationFactory is already set.');
        }
        $this->NeighborhoodsPrefabBuildConfigurationFactory = $buildConfigurationFactory;

        return $this;
    }

    protected function getBuildConfigurationFactory() : FactoryInterface
    {
        if (!$this->hasBuildConfigurationFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationFactory is not set.');
        }

        return $this->NeighborhoodsPrefabBuildConfigurationFactory;
    }

    protected function hasBuildConfigurationFactory() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildConfigurationFactory);
    }

    protected function unsetBuildConfigurationFactory() : self
    {
        if (!$this->hasBuildConfigurationFactory()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildConfigurationFactory);

        return $this;
    }
}

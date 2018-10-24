<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildConfiguration;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : self
    {
        if ($this->hasBuildConfiguration()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfiguration is already set.');
        }
        $this->NeighborhoodsPrefabBuildConfiguration = $buildConfiguration;

        return $this;
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if (!$this->hasBuildConfiguration()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfiguration is not set.');
        }

        return $this->NeighborhoodsPrefabBuildConfiguration;
    }

    protected function hasBuildConfiguration() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildConfiguration);
    }

    protected function unsetBuildConfiguration() : self
    {
        if (!$this->hasBuildConfiguration()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfiguration is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildConfiguration);

        return $this;
    }
}

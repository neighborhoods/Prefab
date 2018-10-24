<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Builder;

use Neighborhoods\Prefab\BuildConfiguration\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabBuildConfigurationBuilder;

    public function setBuildConfigurationBuilder(BuilderInterface $buildConfigurationBuilder) : self
    {
        if ($this->hasBuildConfigurationBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilder is already set.');
        }
        $this->NeighborhoodsPrefabBuildConfigurationBuilder = $buildConfigurationBuilder;

        return $this;
    }

    protected function getBuildConfigurationBuilder() : BuilderInterface
    {
        if (!$this->hasBuildConfigurationBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilder is not set.');
        }

        return $this->NeighborhoodsPrefabBuildConfigurationBuilder;
    }

    protected function hasBuildConfigurationBuilder() : bool
    {
        return isset($this->NeighborhoodsPrefabBuildConfigurationBuilder);
    }

    protected function unsetBuildConfigurationBuilder() : self
    {
        if (!$this->hasBuildConfigurationBuilder()) {
            throw new \LogicException('NeighborhoodsPrefabBuildConfigurationBuilder is not set.');
        }
        unset($this->NeighborhoodsPrefabBuildConfigurationBuilder);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Map;

use Neighborhoods\Prefab\BuildConfiguration\MapInterface;

trait AwareTrait
{
    protected $BuildConfigurations;

    public function setBuildConfigurationMap(MapInterface $BuildConfigurations): self
    {
        if ($this->hasActorMap()) {
            throw new \LogicException('Actors is already set.');
        }
        $this->BuildConfigurations = $BuildConfigurations;

        return $this;
    }

    protected function getBuildConfigurationMap(): MapInterface
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }

        return $this->BuildConfigurations;
    }

    protected function hasActorMap(): bool
    {
        return isset($this->BuildConfigurations);
    }

    protected function unsetBuildConfigurationMap(): self
    {
        if (!$this->hasActorMap()) {
            throw new \LogicException('Actors is not set.');
        }
        unset($this->BuildConfigurations);

        return $this;
    }
}

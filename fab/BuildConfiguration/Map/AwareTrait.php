<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Map;

use Neighborhoods\Prefab\BuildConfiguration\MapInterface;

trait AwareTrait
{
    protected $BuildConfigurations;

    public function setBuildConfigurationMap(MapInterface $BuildConfigurations): self
    {
        if ($this->hasBuildConfigurationMap()) {
            throw new \LogicException('BuildConfigurations is already set.');
        }
        $this->BuildConfigurations = $BuildConfigurations;

        return $this;
    }

    protected function getBuildConfigurationMap(): MapInterface
    {
        if (!$this->hasBuildConfigurationMap()) {
            throw new \LogicException('BuildConfigurations is not set.');
        }

        return $this->BuildConfigurations;
    }

    protected function hasBuildConfigurationMap(): bool
    {
        return isset($this->BuildConfigurations);
    }

    protected function unsetBuildConfigurationMap(): self
    {
        if (!$this->hasBuildConfigurationMap()) {
            throw new \LogicException('BuildConfigurations is not set.');
        }
        unset($this->BuildConfigurations);

        return $this;
    }
}

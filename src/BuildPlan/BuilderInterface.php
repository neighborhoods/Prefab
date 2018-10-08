<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildPlan;


use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildPlanInterface;

interface BuilderInterface
{
    public function build() : BuildPlanInterface;
    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

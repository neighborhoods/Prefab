<?php

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface BuilderInterface
{
    public function build() : FabricationSpecificationInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

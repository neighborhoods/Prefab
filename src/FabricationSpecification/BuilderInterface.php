<?php

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\Factory\AwareTrait;
use Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\FactoryInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

interface BuilderInterface
{
    public function build() : FabricationSpecificationInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

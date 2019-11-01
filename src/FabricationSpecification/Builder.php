<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Builder implements BuilderInterface
{
    use \Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\Factory\AwareTrait;
    use \Neighborhoods\Prefab\FabricationSpecification\Collection\Builder\Factory\AwareTrait;
    use \Neighborhoods\Prefab\FabricationSpecification\Minimal\Builder\Factory\AwareTrait;

    protected $buildConfiguration;

    public function build() : FabricationSpecificationInterface
    {
        $buildConfiguration = $this->getBuildConfiguration();

        switch ($buildConfiguration->getSupportingActorGroup()) {
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COMPLETE:
                return $this->getFabricationSpecificationAllSupportingActorsBuilderFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->build();
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COLLECTION:
                return $this->getFabricationSpecificationCollectionBuilderFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->build();
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_MINIMAL:
                return $this->getFabricationSpecificationMinimalBuilderFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->build();
            default:
                throw new \RuntimeException('Invalid supporting actor group ' . $buildConfiguration->getSupportingActorGroup());
        }
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('Builder buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('Builder buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }
}

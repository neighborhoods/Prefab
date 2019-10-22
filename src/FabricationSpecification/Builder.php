<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Builder implements BuilderInterface
{
    use \Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors\Builder\Factory\AwareTrait;

    protected $buildConfiguration;

    public function build() : FabricationSpecificationInterface
    {
        $buildConfiguration = $this->getBuildConfiguration();

        switch ($buildConfiguration->getSupportingActorGroup()) {
            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COMPLETE:
                return $this->getFabricationSpecificationAllSupportingActorsBuilderFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->build();
//            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_COLLECTION:
//                return $this->getCollectionFactory()->create()
//                    ->setBuildConfiguration($buildConfiguration)
//                    ->setDaoName($daoName)
//                    ->getSupportingActorConfig();
//            case BuildConfigurationInterface::SUPPORTING_ACTOR_GROUP_MINIMAL:
//                return $this->getMinimalFactory()->create()
//                    ->setBuildConfiguration($buildConfiguration)
//                    ->setDaoName($daoName)
//                    ->getSupportingActorConfig();
            default:
                return $this->getFabricationSpecificationAllSupportingActorsBuilderFactory()->create()
                    ->setBuildConfiguration($buildConfiguration)
                    ->build();
//                throw new \RuntimeException('Invalid supporting actor group ' . $buildConfiguration->getSupportingActorGroup());
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

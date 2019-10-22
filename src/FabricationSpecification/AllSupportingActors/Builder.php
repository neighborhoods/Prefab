<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Builder implements BuilderInterface
{
    use \Neighborhoods\Prefab\FabricationSpecification\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Awaretrait\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Map\Factory\AwareTrait;

    protected $buildConfiguration;

    public function build() : FabricationSpecificationInterface
    {
        $buildConfiguration = $this->getBuildConfiguration();

        $actorMap = $this->getActorMapFactory()->create();

        $awareTraitActor = $this->getActorAwareTraitFactory()->create();
        $actorMap->append($awareTraitActor);

        return $this->getFabricationSpecificationFactory()->create()
            ->setActorMap($actorMap);
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

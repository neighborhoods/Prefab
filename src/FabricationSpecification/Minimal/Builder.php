<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\Minimal;

use Neighborhoods\Prefab\ActorConfiguration;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Builder implements BuilderInterface
{
    use \Neighborhoods\Prefab\FabricationSpecification\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Map\Factory\AwareTrait;

    protected $buildConfiguration;

    protected $actorCollection = [
        ActorConfiguration\Actor::class,
        ActorConfiguration\ActorInterface::class,
        ActorConfiguration\ActorServiceFile::class,
        ActorConfiguration\Actor\AwareTrait::class,
        ActorConfiguration\Actor\Factory::class,
        ActorConfiguration\Actor\FactoryInterface::class,
        ActorConfiguration\Actor\FactoryServiceFile::class,
        ActorConfiguration\Actor\Factory\AwareTrait::class,
    ];

    public function build() : FabricationSpecificationInterface
    {
        $buildConfiguration = $this->getBuildConfiguration();

        $actorMap = $this->getActorMapFactory()->create();

        foreach ($this->actorCollection as $actor) {
            $actorMap->append(
                $this->getActorFactory()->create()
                    ->setActorKey($actor::ACTOR_KEY)
                    ->setTemplatePath($actor::TEMPLATE_PATH)
            );
        }

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

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;


use Neighborhoods\Prefab\Bradfab\Template;
use Neighborhoods\Prefab\BuildConfigurationInterface;

class AllSupportingActors implements AllSupportingActorsInterface
{
    use Template\Factory\AwareTrait;

    protected $daoName;
    protected $buildConfiguration;

    public function getSupportingActorConfig() : array
    {
        $supportingActorConfig = $this->getTemplateFactory()->create()
            ->setProjectName($this->getBuildConfiguration()->getProjectName())
            ->setProperties($this->getBuildConfiguration()->getDaoProperties());
        if ($this->getBuildConfiguration()->hasDaoIdentityField()) {
            $supportingActorConfig->setIdentityField(
                $this->getBuildConfiguration()->getDaoIdentityField()
            );
        }

        if ($this->getBuildConfiguration()->hasHttpRoute()) {
            $supportingActorConfig->setRoutePath($this->getBuildConfiguration()->getHttpRoute());
            $supportingActorConfig->setRouteName($this->getDaoName());
        }

        $supportingActorConfig
            ->addAwareTraitActor()
            ->addFactoryActor()
            ->addBuilder()
            ->addHandler()
            ->addRepository()
            ->addMap();

        return $supportingActorConfig->getFabricationConfig();

    }

    protected function getDaoName() : string
    {
        if ($this->daoName === null) {
            throw new \LogicException('AllSupportingActors daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName) : AllSupportingActorsInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('AllSupportingActors daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('AllSupportingActors buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : AllSupportingActorsInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('AllSupportingActors buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }

}

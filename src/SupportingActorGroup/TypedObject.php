<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;


use Neighborhoods\Prefab\Bradfab\Template;
use Neighborhoods\Prefab\BuildConfigurationInterface;

class TypedObject implements TypedObjectInterface
{
    use Template\Factory\AwareTrait;

    protected $daoName;
    protected $buildConfiguration;

    public function getSupportingActorConfig() : array
    {
        $supportingActorConfig = $this->getTemplateFactory()->create()
            ->setProjectName($this->getBuildConfiguration()->getProjectName())
            ->setProperties($this->getBuildConfiguration()->getDaoProperties());

        if ($this->getBuildConfiguration()->hasHttpRoute()) {
            $supportingActorConfig->setRoutePath($this->getBuildConfiguration()->getHttpRoute());
            $supportingActorConfig->setRouteName($this->getDaoName());
        }

        $supportingActorConfig
            ->addAwareTraitActor()
            ->addFactoryActor()
            ->addBuilder();

        return $supportingActorConfig->getFabricationConfig();

    }

    protected function getDaoName() : string
    {
        if ($this->daoName === null) {
            throw new \LogicException('TypedObject daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName) : TypedObjectInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('TypedObject daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('TypedObject buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : TypedObjectInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('TypedObject buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }

}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup;


use Neighborhoods\Prefab\Bradfab\Template;
use Neighborhoods\Prefab\BuildConfigurationInterface;

class Minimal implements MinimalInterface
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
            ->addBuilder();

        return $supportingActorConfig->getFabricationConfig();

    }

    protected function getDaoName() : string
    {
        if ($this->daoName === null) {
            throw new \LogicException('Minimal daoName has not been set.');
        }
        return $this->daoName;
    }

    public function setDaoName(string $daoName) : MinimalInterface
    {
        if ($this->daoName !== null) {
            throw new \LogicException('Minimal daoName is already set.');
        }
        $this->daoName = $daoName;
        return $this;
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('Minimal buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : MinimalInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('Minimal buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }

}

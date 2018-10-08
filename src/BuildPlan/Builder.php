<?php

namespace Neighborhoods\Prefab\BuildPlan;


use Neighborhoods\Prefab\BuildPlan;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\BuildPlanInterface;
use Neighborhoods\Prefab\Console\GeneratorInterface;
use Neighborhoods\Prefab\Console\GeneratorMetaInterface;
use Neighborhoods\Prefab\Actor\AwareTrait;
use Neighborhoods\Prefab\Actor;
use Neighborhoods\Prefab\Actor\Factory;
use Neighborhoods\Prefab\Actor\FactoryInterface;
use Neighborhoods\Prefab\Actor\Handler;
use Neighborhoods\Prefab\Actor\HandlerInterface;
use Neighborhoods\Prefab\Actor\MapBuilder;
use Neighborhoods\Prefab\Actor\MapBuilderInterface;
use Neighborhoods\Prefab\Actor\Map;
use Neighborhoods\Prefab\Actor\MapInterface;
use Neighborhoods\Prefab\Actor\Repository;
use Neighborhoods\Prefab\Actor\RepositoryInterface;
use Neighborhoods\Prefab\Console\GeneratorMeta;

class Builder implements BuilderInterface
{
    use BuildPlan\Factory\AwareTrait;
    use AwareTrait\Generator\Factory\AwareTrait;
    use Actor\Builder\Generator\Factory\AwareTrait;
    use Actor\BuilderInterface\Generator\Factory\AwareTrait;
    use Factory\Generator\Factory\AwareTrait;
    use FactoryInterface\Generator\Factory\AwareTrait;
    use Handler\Generator\Factory\AwareTrait;
    use HandlerInterface\Generator\Factory\AwareTrait;
    use Map\Generator\Factory\AwareTrait;
    use MapBuilder\Generator\Factory\AwareTrait;
    use MapBuilderInterface\Generator\Factory\AwareTrait;
    use MapInterface\Generator\Factory\AwareTrait;
    use Repository\Generator\Factory\AwareTrait;
    use RepositoryInterface\Generator\Factory\AwareTrait;
    use GeneratorMeta\Factory\AwareTrait;

    const FORWARD_SLASH = '/';
    const BACKSLASH = '\\';
    
    protected $buildConfiguration;
    protected $buildPlan;

    public function build() : BuildPlanInterface
    {
        $this->setBuildPlan($this->getBuildPlanFactory()->create());

        $daoMeta = $this->getConsoleGeneratorMetaFactory()->create();

        $daoMeta->setDaoName($this->getBuildConfiguration()->getDaoName());
        $daoMeta->setActorNamespace($this->getBuildConfiguration()->getDaoNamespace());
        $daoMeta->setActorFilePath(
            str_replace(
                '/' . $this->getBuildConfiguration()->getDaoName() . '.dao.yml',
                '', 
                $this->getBuildConfiguration()->getRootSaveLocation()
            )
        );
        $daoMeta->setDaoProperties($this->getBuildConfiguration()->getDaoProperties());

        $this->addDaoInterfaceToPlan($daoMeta);
        $this->addDaoToPlan($daoMeta);

        return $this->getBuildPlan();
    }

    protected function addDaoToPlan(GeneratorMetaInterface $daoMeta) : BuilderInterface
    {
        /** @todo DAO generator logic + Service.yml */

        $nextLevelNamespace = $daoMeta->getActorNamespace() . self::BACKSLASH . $daoMeta->getDaoName();
        $nextLevelFilePath = $daoMeta->getActorFilePath() . self::FORWARD_SLASH . $daoMeta->getDaoName();

        // Once we have a DAO generator, we can pass it to getNextLevelMeta() instead of setting it all here.
        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($daoMeta->getDaoName());

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);
        $this->addMapToPlan($nextLevelMeta);
        $this->addRepositoryToPlan($nextLevelMeta);
        $this->addRepositoryInterfaceToPlan($nextLevelMeta);
        $this->addBuilderToPlan($nextLevelMeta);
        $this->addBuilderInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addDaoInterfaceToPlan(GeneratorMetaInterface $meta) : BuilderInterface
    {

    }

    protected function addAwareTraitToPlan(GeneratorMetaInterface $meta) : BuilderInterface
    {
        $awareTraitGenerator = $this->getActorAwareTraitGeneratorFactory()->create();
        $awareTraitGenerator->setMeta($meta);
        $this->appendGeneratorToBuildPlan($awareTraitGenerator);

        return $this;
    }

    protected function addBuilderToPlan(GeneratorMetaInterface $builderMeta) : BuilderInterface
    {
        $builderGenerator = $this->getActorBuilderGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapBuilderToPlan(GeneratorMetaInterface $builderMeta) : BuilderInterface
    {
        $builderGenerator = $this->getActorMapBuilderGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($builderGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapBuilderInterfaceToPlan(GeneratorMetaInterface $builderMeta) : BuilderInterface
    {
        $builderGenerator = $this->getActorMapBuilderInterfaceGeneratorFactory()->create();
        $builderGenerator->setMeta($builderMeta);
        $this->appendGeneratorToBuildPlan($builderGenerator);

        return $this;
    }

    protected function addBuilderInterfaceToPlan(GeneratorMetaInterface $builderInterfaceMeta) : BuilderInterface
    {
        $builderInterfaceGenerator = $this->getActorBuilderInterfaceGeneratorFactory()->create();
        $builderInterfaceGenerator->setMeta($builderInterfaceMeta);
        $this->appendGeneratorToBuildPlan($builderInterfaceGenerator);

        return $this;
    }

    protected function addFactoryToPlan(GeneratorMetaInterface $factoryMeta) : BuilderInterface
    {
        $factoryGenerator = $this->getActorFactoryGeneratorFactory()->create();
        $factoryGenerator->setMeta($factoryMeta);
        $this->appendGeneratorToBuildPlan($factoryGenerator);
        $this->addFactoryInterfaceToPlan($factoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($factoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);

        return $this;
    }

    protected function addFactoryInterfaceToPlan(GeneratorMetaInterface $factoryInterfaceMeta) : BuilderInterface
    {
        $factoryInterfaceGenerator = $this->getActorFactoryInterfaceGeneratorFactory()->create();
        $factoryInterfaceGenerator->setMeta($factoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($factoryInterfaceGenerator);
        return $this;
    }

    protected function addHandlerToPlan(GeneratorMetaInterface $handlerMeta) : BuilderInterface
    {
        $handlerGenerator = $this->getActorHandlerGeneratorFactory()->create();
        $handlerGenerator->setMeta($handlerMeta);
        $this->appendGeneratorToBuildPlan($handlerGenerator);

        $nextLevelMeta = $this->getNextLevelMeta($handlerGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        return $this;
    }

    protected function addHandlerInterfaceToPlan(GeneratorMetaInterface $handlerInterfaceMeta) : BuilderInterface
    {
        $handlerInterfaceGenerator = $this->getActorHandlerInterfaceGeneratorFactory()->create();
        $handlerInterfaceGenerator->setMeta($handlerInterfaceMeta);
        $this->appendGeneratorToBuildPlan($handlerInterfaceGenerator);
        return $this;
    }

    protected function addMapToPlan(GeneratorMetaInterface $mapMeta) : BuilderInterface
    {
        $mapGenerator = $this->getMapGeneratorFactory()->create();
        $mapGenerator->setMeta($mapMeta);
        $this->appendGeneratorToBuildPlan($mapGenerator);
        $this->addMapInterfaceToPlan($mapMeta);

        $nextLevelMeta = $this->getNextLevelMeta($mapGenerator);
        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addMapBuilderToPlan($nextLevelMeta);
        $this->addMapBuilderInterfaceToPlan($nextLevelMeta);
        $this->addFactoryToPlan($nextLevelMeta);

        return $this;
    }

    protected function addMapInterfaceToPlan(GeneratorMetaInterface $mapInterfaceMeta) : BuilderInterface
    {
        $mapInterfaceGenerator = $this->getMapInterfaceGeneratorFactory()->create();
        $mapInterfaceGenerator->setMeta($mapInterfaceMeta);
        $this->appendGeneratorToBuildPlan($mapInterfaceGenerator);

        return $this;
    }


    protected function addRepositoryToPlan(GeneratorMetaInterface $repositoryMeta) : BuilderInterface
    {
        $repositoryGenerator = $this->getActorRepositoryGeneratorFactory()->create();
        $repositoryGenerator->setMeta($repositoryMeta);
        $this->appendGeneratorToBuildPlan($repositoryGenerator);
        $this->addRepositoryInterfaceToPlan($repositoryMeta);

        $nextLevelMeta = $this->getNextLevelMeta($repositoryGenerator);

        $this->addAwareTraitToPlan($nextLevelMeta);
        $this->addHandlerToPlan($nextLevelMeta);
        $this->addHandlerInterfaceToPlan($nextLevelMeta);

        return $this;
    }

    protected function addRepositoryInterfaceToPlan(GeneratorMetaInterface $repositoryInterfaceMeta) : BuilderInterface
    {
        $repositoryInterfaceGenerator = $this->getActorRepositoryInterfaceGeneratorFactory()->create();
        $repositoryInterfaceGenerator->setMeta($repositoryInterfaceMeta);
        $this->appendGeneratorToBuildPlan($repositoryInterfaceGenerator);

        return $this;
    }

    protected function getNextLevelMeta(GeneratorInterface $parentGenerator) : GeneratorMetaInterface
    {
        $parentMeta = $parentGenerator->getMeta();
        $actorName = $parentGenerator->getActorName();
        $nextLevelNamespace = $parentMeta->getActorNamespace() . self::BACKSLASH . $actorName;
        $nextLevelFilePath = $parentMeta->getActorFilePath() . self::FORWARD_SLASH . $actorName;

        $nextLevelMeta = $this->getConsoleGeneratorMetaFactory()->create();
        $nextLevelMeta->setActorNamespace($nextLevelNamespace);
        $nextLevelMeta->setActorFilepath($nextLevelFilePath);
        $nextLevelMeta->setDaoName($parentMeta->getDaoName());

        return $nextLevelMeta;
    }

    protected function appendGeneratorToBuildPlan(GeneratorInterface $generator) : BuilderInterface
    {
        $this->getBuildPlan()->appendGenerator($generator);
        return $this;
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

    protected function getBuildPlan() : BuildPlanInterface
    {
        if ($this->buildPlan === null) {
            throw new \LogicException('Builder buildPlan has not been set.');
        }
        return $this->buildPlan;
    }

    protected function setBuildPlan(BuildPlanInterface $buildPlan) : BuilderInterface
    {
        if ($this->buildPlan !== null) {
            throw new \LogicException('Builder buildPlan is already set.');
        }
        $this->buildPlan = $buildPlan;
        return $this;
    }
}

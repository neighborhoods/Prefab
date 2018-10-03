<?php

namespace Neighborhoods\Prefab\Console;

use Neighborhoods\Prefab\Actor\AwareTrait;
use Neighborhoods\Prefab\Actor\Factory;
use Neighborhoods\Prefab\Actor\MapInterface;
use Neighborhoods\Prefab\Actor\Repository;
use Neighborhoods\Prefab\Actor\Builder;
use Neighborhoods\Prefab\Actor\Map;
use Neighborhoods\Prefab\Actor\MapBuilder;
use Neighborhoods\Prefab\Actor\MapBuilderInterface;
use Neighborhoods\Prefab\Actor\RepositoryInterface;
use Neighborhoods\Prefab\Actor\Handler;
use Neighborhoods\Prefab\Actor\BuilderInterface;
use Neighborhoods\Prefab\Actor\FactoryInterface;

interface GenerateFabCommandInterface
{
    public function setActorFactoryInterfaceGeneratorFactory(FactoryInterface\Generator\FactoryInterface $actorFactoryInterfaceGeneratorFactory);

    public function setMapInterfaceGeneratorFactory(MapInterface\Generator\FactoryInterface $mapInterfaceGeneratorFactory);

    public function setActorRepositoryGeneratorFactory(Repository\Generator\FactoryInterface $actorRepositoryGeneratorFactory);

    public function setActorBuilderGeneratorFactory(Builder\Generator\FactoryInterface $actorBuilderGeneratorFactory);

    public function setConsoleGeneratorMetaFactory(GeneratorMeta\FactoryInterface $consoleGeneratorMetaFactory);

    public function setMapGeneratorFactory(Map\Generator\FactoryInterface $mapGeneratorFactory);

    public function setActorMapBuilderInterfaceGeneratorFactory(MapBuilderInterface\Generator\FactoryInterface $actorMapBuilderInterfaceGeneratorFactory);

    public function setActorRepositoryInterfaceGeneratorFactory(RepositoryInterface\Generator\FactoryInterface $actorRepositoryInterfaceGeneratorFactory);

    public function setActorFactoryGeneratorFactory(Factory\Generator\FactoryInterface $actorFactoryGeneratorFactory);

    public function setActorHandlerGeneratorFactory(Handler\Generator\FactoryInterface $actorHandlerGeneratorFactory);

    public function setActorBuilderInterfaceGeneratorFactory(BuilderInterface\Generator\FactoryInterface $actorBuilderInterfaceGeneratorFactory);

    public function setActorMapBuilderGeneratorFactory(MapBuilder\Generator\FactoryInterface $actorMapBuilderGeneratorFactory);

    public function setActorAwareTraitGeneratorFactory(AwareTrait\Generator\FactoryInterface $actorAwareTraitGeneratorFactory);

    public function getProjectName(): string;

    public function setProjectName(string $projectName): GenerateFabCommandInterface;
}

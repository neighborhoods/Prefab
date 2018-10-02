<?php
/**
 * Created by PhpStorm.
 * User: jacobmalachowski
 * Date: 10/1/18
 * Time: 1:47 PM
 */

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
use Neighborhoods\Prefab\Actor\HandlerInterface;
use Neighborhoods\Prefab\Actor\FactoryInterface;

interface GenerateFabCommandInterface
{
    public function setActorFactoryInterfaceGeneratorFactory(FactoryInterface\Generator\FactoryInterface $actorFactoryInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setMapInterfaceGeneratorFactory(MapInterface\Generator\FactoryInterface $mapInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setActorRepositoryGeneratorFactory(Repository\Generator\FactoryInterface $actorRepositoryGeneratorFactory) : GenerateFabCommand;

    public function setActorBuilderGeneratorFactory(Builder\Generator\FactoryInterface $actorBuilderGeneratorFactory) : GenerateFabCommand;

    public function setConsoleGeneratorMetaFactory(GeneratorMeta\FactoryInterface $consoleGeneratorMetaFactory) : GenerateFabCommand;

    public function setMapGeneratorFactory(Map\Generator\FactoryInterface $mapGeneratorFactory) : GenerateFabCommand;

    public function setActorMapBuilderInterfaceGeneratorFactory(MapBuilderInterface\Generator\FactoryInterface $actorMapBuilderInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setActorRepositoryInterfaceGeneratorFactory(RepositoryInterface\Generator\FactoryInterface $actorRepositoryInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setActorFactoryGeneratorFactory(Factory\Generator\FactoryInterface $actorFactoryGeneratorFactory) : GenerateFabCommand;

    public function setActorHandlerGeneratorFactory(Handler\Generator\FactoryInterface $actorHandlerGeneratorFactory) : GenerateFabCommand;

    public function setActorBuilderInterfaceGeneratorFactory(BuilderInterface\Generator\FactoryInterface $actorBuilderInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setActorHandlerInterfaceGeneratorFactory(HandlerInterface\Generator\FactoryInterface $actorHandlerInterfaceGeneratorFactory) : GenerateFabCommand;

    public function setActorMapBuilderGeneratorFactory(MapBuilder\Generator\FactoryInterface $actorMapBuilderGeneratorFactory) : GenerateFabCommand;

    public function setActorAwareTraitGeneratorFactory(AwareTrait\Generator\FactoryInterface $actorAwareTraitGeneratorFactory) : GenerateFabCommand;
}

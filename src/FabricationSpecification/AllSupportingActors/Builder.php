<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FabricationSpecification\AllSupportingActors;

use Neighborhoods\Prefab\ActorConfiguration;
use Neighborhoods\Prefab\AnnotationProcessorRecord;
use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\FabricationSpecificationInterface;

class Builder implements BuilderInterface
{
    use \Neighborhoods\Prefab\FabricationSpecification\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Factory\AwareTrait;
    use \Neighborhoods\Prefab\Actor\Map\Factory\AwareTrait;
    use \Neighborhoods\Prefab\AnnotationProcessorRecord\Map\Factory\AwareTrait;
    use \Neighborhoods\Prefab\AnnotationProcessorRecord\Builder\Factory\AwareTrait;

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
        ActorConfiguration\Actor\Builder::class,
        ActorConfiguration\Actor\BuilderInterface::class,
        ActorConfiguration\Actor\BuilderServiceFile::class,
        ActorConfiguration\Actor\Builder\AwareTrait::class,
        ActorConfiguration\Actor\Builder\Factory::class,
        ActorConfiguration\Actor\Builder\FactoryInterface::class,
        ActorConfiguration\Actor\Builder\FactoryServiceFile::class,
        ActorConfiguration\Actor\Builder\Factory\AwareTrait::class,
        ActorConfiguration\Actor\Map::class,
        ActorConfiguration\Actor\MapInterface::class,
        ActorConfiguration\Actor\MapServiceFile::class,
        ActorConfiguration\Actor\Map\AwareTrait::class,
        ActorConfiguration\Actor\Map\Factory::class,
        ActorConfiguration\Actor\Map\FactoryInterface::class,
        ActorConfiguration\Actor\Map\FactoryServiceFile::class,
        ActorConfiguration\Actor\Map\Factory\AwareTrait::class,
        ActorConfiguration\Actor\Map\Builder::class,
        ActorConfiguration\Actor\Map\BuilderInterface::class,
        ActorConfiguration\Actor\Map\BuilderServiceFile::class,
        ActorConfiguration\Actor\Map\Builder\AwareTrait::class,
        ActorConfiguration\Actor\Map\Builder\Factory::class,
        ActorConfiguration\Actor\Map\Builder\FactoryInterface::class,
        ActorConfiguration\Actor\Map\Builder\FactoryServiceFile::class,
        ActorConfiguration\Actor\Map\Builder\Factory\AwareTrait::class,
        ActorConfiguration\Actor\Map\Repository::class,
        ActorConfiguration\Actor\Map\RepositoryInterface::class,
        ActorConfiguration\Actor\Map\RepositoryServiceFile::class,
        ActorConfiguration\Actor\Map\Repository\AwareTrait::class,
        ActorConfiguration\Actor\Map\Repository\Handler::class,
        ActorConfiguration\Actor\Map\Repository\HandlerInterface::class,
        ActorConfiguration\Actor\Map\Repository\HandlerServiceFile::class,
    ];

    public function build() : FabricationSpecificationInterface
    {
        $actorMap = $this->getActorMapFactory()->create();

        foreach ($this->actorCollection as $actor) {
            $annotationProcessorMap = $this->buildAnnotationProcessorMapForActor($actor);

            $actorMap->append(
                $this->getActorFactory()->create()
                    ->setActorKey($actor::ACTOR_KEY)
                    ->setTemplatePath($actor::TEMPLATE_PATH)
                    ->setAnnotationProcessorRecordMap($annotationProcessorMap)
            );
        }

        return $this->getFabricationSpecificationFactory()->create()
            ->setActorMap($actorMap);
    }

    protected function buildAnnotationProcessorMapForActor(string $actor) : AnnotationProcessorRecord\MapInterface
    {
        $annotationProcessorMap = $this->getAnnotationProcessorRecordMapFactory()->create();
        /** @noinspection PhpUndefinedFieldInspection */
        foreach ($actor::ANNOTATION_PROCESSORS as $annotationProcessor) {
            $annotationProcessorBuilder = $this->getAnnotationProcessorRecordBuilderFactory()->create();
            $annotationProcessor = $annotationProcessorBuilder
                ->setAnnotationProcessorKey($annotationProcessor[AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY])
                ->setStaticContextRecordBuilder((new $annotationProcessor[AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER]))
                ->setProcessorFullyQualifiedClassname($annotationProcessor[AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME])
                ->setBuildConfiguration($this->getBuildConfiguration())
                ->build();

            if ($annotationProcessor->hasAnnotationProcessorKey()) {
                $annotationProcessorMap->append($annotationProcessor);
            }
        }

        return $annotationProcessorMap;
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

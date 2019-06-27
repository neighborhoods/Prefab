<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


use Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder;
use Neighborhoods\Prefab\DaoPropertyInterface;

class BuilderActor implements BuilderActorInterface
{
    use AwareTraitActor\Factory\AwareTrait;
    use FactoryActor\Factory\AwareTrait;

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_PROPERTIES = 'properties';

    protected $properties;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::BUILDER_ACTOR_KEY => $this->getBuilderActor(),
                self::BUILDER_INTERFACE_ACTOR_KEY => $this->getBuilderInterfaceActor(),
                self::BUILDER_SERVICE_FILE_ACTOR_KEY => $this->getBuilderServiceFileActory(),
                self::BUILDER_KEY . '\\' . AwareTraitActor::ACTOR_KEY =>
                    $this->getAwareTraitActorFactory()->create()
                        ->getActorConfiguration()[AwareTraitActor::ACTOR_KEY],
            ];

        return array_merge(
            $config,
            $this->getFactoryActorFactory()->create()
                ->setKeyPrefix(self::BUILDER_KEY)->getActorConfiguration()
        );
    }

    protected function getBuilderActor() : ?array
    {
        if (!$this->hasProperties()) {
            return null;
        }

        $propertyArray = [];

        /** @var DaoPropertyInterface $daoProperty */
        foreach ($this->getProperties() as $daoProperty) {
            $propertyArray[$daoProperty->getName()] = [
                'nullable' => $daoProperty->isNullable(),
                'data_type' => $daoProperty->getDataType(),
            ];
        }

        return
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        Builder::ANNOTATION_PROCESSOR_KEY => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Builder::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_PROPERTIES => $propertyArray,
                            ],
                        ],
                    ],
            ];
    }

    protected function getBuilderInterfaceActor() : ?array
    {
        return null;
    }

    protected function getBuilderServiceFileActory() : ?array
    {
        return null;
    }

    protected function getProperties() : array
    {
        if ($this->properties === null) {
            throw new \LogicException('BuilderActor properties has not been set.');
        }
        return $this->properties;
    }

    public function setProperties($properties) : BuilderActorInterface
    {
        if ($this->properties !== null) {
            throw new \LogicException('BuilderActor properties is already set.');
        }
        $this->properties = $properties;
        return $this;
    }

    protected function hasProperties() : bool
    {
        return $this->properties !== null;
    }

}

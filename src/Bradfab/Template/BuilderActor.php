<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


use Neighborhoods\Prefab\AnnotationProcessor\Actor\Builder;

class BuilderActor
{
    public const BUILDER_KEY = 'Builder';

    public const BUILDER_ACTOR_KEY = 'Builder.php';
    public const BUILDER_INTERFACE_ACTOR_KEY = 'BuilderInterface.php';
    public const BUILDER_SERVICE_FILE_ACTOR_KEY = 'Builder.service.yml';

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_PROPERTIES = 'properties';

    protected $properties;

    public function getActorConfiguration() : array
    {
        return
        [
            self::BUILDER_ACTOR_KEY => $this->getBuilderActor(),
            self::BUILDER_INTERFACE_ACTOR_KEY => $this->getBuilderInterfaceActor(),
            self::BUILDER_SERVICE_FILE_ACTOR_KEY => $this->getBuilderServiceFileActory(),
            self::BUILDER_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY]
        ];
    }

    protected function getBuilderActor() : ?array
    {
        if (!$this->hasProperties()) {
            return null;
        }

        $propertyArray = [];

        foreach ($this->getProperties() as $propertyName => $propertyValues) {
            $propertyArray[$propertyName] = [
                'nullable' => $propertyValues['nullable'] ?? false,
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

    protected function getProperties()
    {
        if ($this->properties === null) {
            throw new \LogicException('BuilderActor properties has not been set.');
        }
        return $this->properties;
    }

    public function setProperties($properties)
    {
        if ($this->properties !== null) {
            throw new \LogicException('BuilderActor properties is already set.');
        }
        $this->properties = $properties;
        return $this;
    }

    public function hasProperties() : bool
    {
        return $this->properties !== null;
    }

}

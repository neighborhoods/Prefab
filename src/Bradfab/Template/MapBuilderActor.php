<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Builder;


class MapBuilderActor implements MapBuilderActorInterface
{
    use FactoryActor\Factory\AwareTrait;

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';
    protected const CONTEXT_KEY_IDENTITY_FIELD = 'identity_field';

    protected $identity_field;

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::MAP_BUILDER_ACTOR_KEY => $this->getMapBuilderActor(),
                self::MAP_BUILDER_INTERFACE_ACTOR_KEY => null,
                self::MAP_BUILDER_SERVICE_FILE_ACTOR_KEY => null,
                self::MAP_BUILDER_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY],
            ];

        return array_merge(
            $config,
            $this->getFactoryActorFactory()->create()
                ->setKeyPrefix(self::MAP_BUILDER_KEY)->getActorConfiguration()
        );
    }

    protected function getMapBuilderActor() : ?array
    {
        if (!$this->hasIdentityField()) {
            return null;
        }

        return
            [
                self::KEY_ANNOTATION_PROCESSORS =>
                    [
                        Builder::ANNOTATION_PROCESSOR_KEY => [
                            self::KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME => '\\' . Builder::class,
                            self::KEY_STATIC_CONTEXT_RECORD => [
                                self::CONTEXT_KEY_IDENTITY_FIELD => $this->getIdentityField(),
                            ],
                        ],
                    ],
            ];
    }

    protected function getIdentityField()
    {
        if ($this->identity_field === null) {
            throw new \LogicException('MapBuilderActor identity_field has not been set.');
        }
        return $this->identity_field;
    }

    public function setIdentityField($identity_field) : MapBuilderActorInterface
    {
        if ($this->identity_field !== null) {
            throw new \LogicException('MapBuilderActor identity_field is already set.');
        }
        $this->identity_field = $identity_field;
        return $this;
    }

    protected function hasIdentityField() : bool
    {
        return $this->identity_field !== null;
    }
}

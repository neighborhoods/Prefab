<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;


class MapBuilderActor
{
    public const MAP_BUILDER_KEY = 'Map\Builder';

    public const MAP_BUILDER_ACTOR_KEY = 'Map\Builder.php';
    public const MAP_BUILDER_INTERFACE_ACTOR_KEY = 'Map\BuilderInterface.php';
    public const MAP_BUILDER_SERVICE_FILE_ACTOR_KEY = 'Map\Builder.service.yml';

    protected const KEY_ANNOTATION_PROCESSORS = 'annotation_processors';
    protected const KEY_PROCESSOR_FULLY_QUALIFIED_CLASSNAME = 'processor_fqcn';
    protected const KEY_STATIC_CONTEXT_RECORD = 'static_context_record';

    protected const CONTEXT_KEY_PROPERTIES = 'properties';

    public function getActorConfiguration() : array
    {
        $config =
            [
                self::MAP_BUILDER_ACTOR_KEY => null,
                self::MAP_BUILDER_INTERFACE_ACTOR_KEY => null,
                self::MAP_BUILDER_SERVICE_FILE_ACTOR_KEY => null,
                self::MAP_BUILDER_KEY . '\\' . AwareTraitActor::ACTOR_KEY => (new AwareTraitActor())->getActorConfiguration()[AwareTraitActor::ACTOR_KEY],
            ];

        return array_merge($config, (new FactoryActor())->setKeyPrefix(self::MAP_BUILDER_KEY)->getActorConfiguration());
    }

}

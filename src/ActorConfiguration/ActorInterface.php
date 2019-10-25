<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

interface ActorInterface
{
    public const ACTOR_KEY = '<ActorName>Interface.php';
    public const TEMPLATE_PATH = 'ActorInterface.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS = 'DaoPropertiesAndAccessors';

    public const STATIC_CONTEXT_RECORD_BUILDERS = [
        self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors\Builder::class
    ];
}

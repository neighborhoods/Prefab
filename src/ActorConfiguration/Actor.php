<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;


interface Actor
{
    public const ACTOR_KEY = '<ActorName>.php';
    public const TEMPLATE_PATH = 'Actor.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS = 'DaoPropertiesAndAccessors';

    public const STATIC_CONTEXT_RECORD_BUILDERS = [
        self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\DaoPropertiesAndAccessors\Builder::class
    ];
}

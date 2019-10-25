<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;


interface Actor
{
    public const ACTOR_KEY = '<ActorName>.php';
    public const TEMPLATE_PATH = 'Actor.php';
    public const STATIC_CONTEXT_RECORD_BUILDERS = [
        \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\DaoPropertiesAndAccessors\Builder::class
    ];
}

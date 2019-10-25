<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

interface ActorInterface
{
    public const ACTOR_KEY = '<ActorName>Interface.php';
    public const TEMPLATE_PATH = 'ActorInterface.php';
    public const STATIC_CONTEXT_RECORD_BUILDERS = [
        \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors\Builder::class
    ];
}

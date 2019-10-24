<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

use Neighborhoods\Prefab\AnnotationProcessorRecord;

interface Actor
{
    public const ACTOR_KEY = '<ActorName>.php';
    public const TEMPLATE_PATH = 'Actor.php';
    public const ANNOTATION_PROCESSOR_RECORD_BUILDERS = [
        AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors\Builder::class
    ];
}

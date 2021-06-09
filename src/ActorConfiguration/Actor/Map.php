<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface Map
{
    public const ACTOR_KEY = '<PrimaryActorName>/Map.php';
    public const TEMPLATE_PATH = 'PrimaryActorName/Map.php';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\MapJsonSerializeMethod::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\MapJsonSerializeMethod::class,
        ],
    ];
}

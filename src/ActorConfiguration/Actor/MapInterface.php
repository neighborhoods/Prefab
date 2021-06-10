<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface MapInterface
{
    public const ACTOR_KEY = '<PrimaryActorName>/MapInterface.php';
    public const TEMPLATE_PATH = 'PrimaryActorName/MapInterface.php';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\MapInterfaceJsonSerializable::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\MapInterface\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\MapInterfaceJsonSerializable::class,
        ],
    ];
}

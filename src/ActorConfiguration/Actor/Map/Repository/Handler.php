<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map\Repository;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
interface Handler
{
    public const ACTOR_KEY = '<PrimaryActorName>/Map/Repository/Handler.php';
    public const TEMPLATE_PATH = 'PrimaryActorName/Map/Repository/Handler.php';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerUseGlobalTracerRepositoryAwareTrait::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerUseGlobalTracerRepositoryAwareTrait::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerSetFilterFieldsTracerTag::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerSetFilterFieldsTracerTag::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerCallSetFilterFieldsTracerTag::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerCallSetFilterFieldsTracerTag::class,
        ]
    ];
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map\Repository;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
interface HandlerServiceFile
{
    public const ACTOR_KEY = '<PrimaryActorName>/Map/Repository/Handler.service.yml';
    public const TEMPLATE_PATH = 'PrimaryActorName/Map/Repository/Handler.service.yml';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerServiceFile::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerServiceFile::class,
        ]
    ];
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map\Repository;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface HandlerServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Map/Repository/Handler.service.yml';
    public const TEMPLATE_PATH = 'Actor/Map/Repository/Handler.service.yml';
    public const ANNOTATION_PROCESSOR_KEY_NAMESPACE = 'Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_NAMESPACE,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\HandlerServiceFile\ProjectNamespaceSearchCriteria\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::class,
        ]
    ];
}

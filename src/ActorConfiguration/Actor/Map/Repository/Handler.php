<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map\Repository;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface Handler
{
    public const ACTOR_KEY = '<ActorName>/Map/Repository/Handler.php';
    public const TEMPLATE_PATH = 'Actor/Map/Repository/Handler.php';
    public const ANNOTATION_PROCESSOR_KEY_PROJECT_NAME_HTTP_MESSAGE = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-ProjectName-Http\Message';
    public const ANNOTATION_PROCESSOR_KEY_PROJECT_NAME_SEARCH_CRITERIA = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-ProjectName-SearchCriteria';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_PROJECT_NAME_HTTP_MESSAGE,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\ProjectNamespaceHttpMessage\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_PROJECT_NAME_SEARCH_CRITERIA,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\ProjectNamespaceSearchCriteria\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::class,
        ],
    ];
}

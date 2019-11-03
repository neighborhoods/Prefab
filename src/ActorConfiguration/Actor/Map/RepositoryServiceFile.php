<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface RepositoryServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Map/Repository.service.yml';
    public const TEMPLATE_PATH = 'Actor/Map/Repository.service.yml';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::ANNOTATION_PROCESSOR_KEY . '-Doctrine',
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\RepositoryServiceFile\ProjectNameNamespaceDbal\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::ANNOTATION_PROCESSOR_KEY . '-SearchCriteria',
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\RepositoryServiceFile\ProjectNameNamespaceSearchCriteria\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\NamespaceAnnotationProcessor::class,
        ],
    ];
}

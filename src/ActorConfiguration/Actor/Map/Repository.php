<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface Repository
{
    public const ACTOR_KEY = '<ActorName>/Map/Repository.php';
    public const TEMPLATE_PATH = 'Actor/Map/Repository.php';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\ProjectNameNamespaces\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryJsonColumns::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\JsonColumns\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryJsonColumns::class,
        ],
    ];
}

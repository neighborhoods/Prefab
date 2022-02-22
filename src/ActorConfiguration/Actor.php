<?php

declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\DaoPropertiesAndAccessors;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\UseNamespaces;
use Neighborhoods\Prefab\AnnotationProcessor;

interface Actor
{
    public const ACTOR_KEY = '<PrimaryActorName>.php';
    public const TEMPLATE_PATH = 'PrimaryActorName.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS = 'DaoPropertiesAndAccessors';
    public const ANNOTATION_PROCESSOR_KEY_USE_NAMESPACES = 'UseNamespaces';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => DaoPropertiesAndAccessors\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => AnnotationProcessor\DAO::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_USE_NAMESPACES,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => UseNamespaces\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => AnnotationProcessor\UseNamespaces::class,
        ]
    ];
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\TableName;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\UseNamespaces;
use Neighborhoods\Prefab\AnnotationProcessor;

interface ActorInterface
{
    public const ACTOR_KEY = '<PrimaryActorName>Interface.php';
    public const TEMPLATE_PATH = 'PrimaryActorNameInterface.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES = 'DaoAccessors';
    public const ANNOTATION_PROCESSOR_KEY_TABLE_NAME = 'TableName';
    public const ANNOTATION_PROCESSOR_KEY_USE_NAMESPACES = 'UseNamespaces';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => DaoPropertiesAndAccessors\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => AnnotationProcessor\DAOInterfaceProperties::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_TABLE_NAME,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => TableName\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => AnnotationProcessor\DAOInterfaceTableName::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_USE_NAMESPACES,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => UseNamespaces\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => AnnotationProcessor\UseNamespaces::class,
        ]
    ];
}

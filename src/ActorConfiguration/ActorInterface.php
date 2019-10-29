<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface ActorInterface
{
    public const ACTOR_KEY = '<ActorName>Interface.php';
    public const TEMPLATE_PATH = 'ActorInterface.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES = 'DaoAccessors';
    public const ANNOTATION_PROCESSOR_KEY_TABLE_NAME = 'TableName';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\DAOInterfaceProperties::class,
        ],
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_TABLE_NAME,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\TableName\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\DAOInterfaceTableName::class,
        ],
    ];
}

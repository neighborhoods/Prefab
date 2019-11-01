<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface Actor
{
    public const ACTOR_KEY = '<ActorName>.php';
    public const TEMPLATE_PATH = 'Actor.php';
    public const ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS = 'DaoPropertiesAndAccessors';

    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::ANNOTATION_PROCESSOR_KEY_DAO_PROPERTIES_AND_ACCESSORS,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\DaoPropertiesAndAccessors\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\DAO::class,
        ],
    ];
}

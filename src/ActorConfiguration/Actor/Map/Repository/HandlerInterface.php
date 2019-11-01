<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor\Map\Repository;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface HandlerInterface
{
    public const ACTOR_KEY = '<ActorName>/Map/Repository/HandlerInterface.php';
    public const TEMPLATE_PATH = 'Actor/Map/Repository/HandlerInterface.php';
    public const KEY_HANDLER_INTERFACE_CONSTANTS = 'Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\HandlerInterface-CONSTANTS';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => self::KEY_HANDLER_INTERFACE_CONSTANTS,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\HandlerInterface\RouteConstants\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\Repository\HandlerInterface::class,
        ],
    ];
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ActorConfiguration\Actor;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface BuilderServiceFile
{
    public const ACTOR_KEY = '<ActorName>/Builder.service.yml';
    public const TEMPLATE_PATH = 'Actor/Builder.service.yml';
    public const ANNOTATION_PROCESSORS = [
        [
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_KEY => \Neighborhoods\Prefab\AnnotationProcessor\Actor\BuilderServiceFile::ANNOTATION_PROCESSOR_KEY,
            AnnotationProcessorRecordInterface::KEY_STATIC_CONTEXT_RECORD_BUILDER => \Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\BuilderServiceFile\FactorySetters\Builder::class,
            AnnotationProcessorRecordInterface::KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME => \Neighborhoods\Prefab\AnnotationProcessor\Actor\BuilderServiceFile::class,
        ]
    ];
}

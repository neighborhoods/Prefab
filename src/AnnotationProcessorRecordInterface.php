<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface AnnotationProcessorRecordInterface
{
    public const KEY_STATIC_CONTEXT_RECORD_BUILDER = 'static_context_record_builder';
    public const KEY_ANNOTATION_PROCESSOR_FULLY_QUALIFIED_CLASS_NAME = 'processor_fqcn';
    public const KEY_ANNOTATION_PROCESSOR_KEY = 'annotation_processor_key';

    public function getProcessorFullyQualifiedClassname(): string;
    public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorRecordInterface;
    public function hasProcessorFullyQualifiedClassname() : bool;

    public function getStaticContextRecord(): array;
    public function setStaticContextRecord(array $staticContextRecord): AnnotationProcessorRecordInterface;
    public function hasStaticContextRecord() : bool;

    public function getAnnotationProcessorKey(): string;
    public function setAnnotationProcessorKey(string $annotationProcessorKey): AnnotationProcessorRecordInterface;
    public function hasAnnotationProcessorKey() : bool;
}

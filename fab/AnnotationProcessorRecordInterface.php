<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface AnnotationProcessorRecordInterface
{
     public function getProcessorFullyQualifiedClassname(): string;
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorRecordInterface;

     public function getStaticContextRecord(): array;
     public function setStaticContextRecord(array $staticContextRecord): AnnotationProcessorRecordInterface;
}

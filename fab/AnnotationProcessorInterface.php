<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface AnnotationProcessorInterface
{
     public function getProcessorFullyQualifiedClassname(): string;
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorInterface;

     public function getStaticContextRecord(): string;
     public function setStaticContextRecord(string $staticContextRecord): AnnotationProcessorInterface;
}

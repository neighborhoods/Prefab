<?php

namespace Neighborhoods\Prefab;

interface AnnotationProcessorInterface
{
    public function getProcessorFullyQualifiedClassname() : string;

    public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname) : AnnotationProcessorInterface;

    public function getStaticContextRecord() : array;

    public function setStaticContextRecord(array $staticContextRecord) : AnnotationProcessorInterface;
}

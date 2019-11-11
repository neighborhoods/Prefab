<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

interface StaticContextRecordInterface extends \JsonSerializable
{


    public function getProcessorFullyQualifiedClassname(): string;
    public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): StaticContextRecordInterface;
    public function hasProcessorFullyQualifiedClassname(): bool;

    public function getStaticContextRecord(): array;
    public function setStaticContextRecord(array $staticContextRecord): StaticContextRecordInterface;
    public function hasStaticContextRecord(): bool;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;

interface FactoryInterface
{
    public function create(): StaticContextRecordInterface;
}

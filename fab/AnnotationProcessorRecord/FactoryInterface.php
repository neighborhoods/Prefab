<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

interface FactoryInterface
{
    public function create(): AnnotationProcessorRecordInterface;
}

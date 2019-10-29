<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): StaticContextRecordInterface
    {
        return clone $this->getAnnotationProcessorRecordStaticContextRecord();
    }
}

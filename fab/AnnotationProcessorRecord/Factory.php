<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): AnnotationProcessorRecordInterface
    {
        return clone $this->getAnnotationProcessorRecord();
    }
}

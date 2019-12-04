<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getAnnotationProcessorRecordStaticContextRecordMap()->getArrayCopy();
    }
}

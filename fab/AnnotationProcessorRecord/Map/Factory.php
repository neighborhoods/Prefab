<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getAnnotationProcessorRecordMap()->getArrayCopy();
    }
}

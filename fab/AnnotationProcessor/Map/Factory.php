<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Map;

use Neighborhoods\Prefab\AnnotationProcessor\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getAnnotationProcessorMap()->getArrayCopy();
    }
}

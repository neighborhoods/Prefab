<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Prefab\AnnotationProcessorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): AnnotationProcessorInterface
    {
        return clone $this->getAnnotationProcessor();
    }
}

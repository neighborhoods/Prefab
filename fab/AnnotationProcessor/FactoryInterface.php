<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor;

use Neighborhoods\Prefab\AnnotationProcessorInterface;

interface FactoryInterface
{
    public function create(): AnnotationProcessorInterface;
}

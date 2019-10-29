<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Builder;

use Neighborhoods\Prefab\AnnotationProcessorRecord\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

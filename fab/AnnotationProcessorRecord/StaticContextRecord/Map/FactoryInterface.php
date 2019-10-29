<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

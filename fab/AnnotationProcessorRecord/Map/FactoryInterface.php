<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Map;

use Neighborhoods\Prefab\AnnotationProcessorRecord\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

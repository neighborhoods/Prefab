<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessor\Map;

use Neighborhoods\Prefab\AnnotationProcessor\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

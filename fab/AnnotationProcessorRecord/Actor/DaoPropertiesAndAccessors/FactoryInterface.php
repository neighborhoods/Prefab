<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessorsInterface;

interface FactoryInterface
{
    public function create(): DaoPropertiesAndAccessorsInterface;
}

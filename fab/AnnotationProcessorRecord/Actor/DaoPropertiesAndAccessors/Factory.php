<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessorsInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): DaoPropertiesAndAccessorsInterface
    {
        return clone $this->getAnnotationProcessorRecordActorDaoPropertiesAndAccessors();
    }
}

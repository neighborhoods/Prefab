<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Builder\BuildMethod;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\DaoPropertyInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $staticContextRecord = [];
        $propertyArray = [];

        /** @var DaoPropertyInterface $daoProperty */
        foreach ($this->getBuildConfiguration()->getDaoProperties() as $daoProperty) {
            $propertyArray[$daoProperty->getName()] = [
                'nullable' => $daoProperty->getNullable(),
                'data_type' => $daoProperty->getDataType(),
                'created_on_insert' => $daoProperty->getCreatedOnInsert(),
            ];
        }

        $staticContextRecord['properties'] = $propertyArray;

        return $staticContextRecord;
    }

    protected function getBuildConfiguration() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('Builder buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('Builder buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
    }
}

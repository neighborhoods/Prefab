<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessor\DAOInterfaceProperties;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $buildConfiguration = $this->getBuildConfiguration();
        $staticContextRecord = [];

        if ($this->getBuildConfiguration()->hasConstantMap()) {
            foreach ($this->getBuildConfiguration()->getConstantMap() as $constant) {
                $staticContextRecord[DAOInterfaceProperties::STATIC_CONTEXT_RECORD_KEY_CONSTANTS][] = [
                    'name' => $constant->getName(),
                    'value' => $constant->getValue()
                ];
            }
        }

        foreach ($buildConfiguration->getDaoPropertyMap() as $property) {
            $staticContextRecord[DAOInterfaceProperties::STATIC_CONTEXT_RECORD_KEY_PROPERTIES][] = [
                'name' => $property->getName(),
                'type' => $property->getDataType(),
                'record_key' => $property->getRecordKey()
            ];
        }

        return $staticContextRecord;
    }

    public function getBuildConfiguration() : BuildConfigurationInterface
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

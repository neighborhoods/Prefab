<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\JsonColumns;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\DaoPropertyInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;
use Neighborhoods\Prefab\AnnotationProcessor;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $buildConfiguration = $this->getBuildConfiguration();
        $staticContextRecord = [];

        foreach ($buildConfiguration->getDaoPropertyMap() as $property) {
            $staticContextRecord[] = [
                AnnotationProcessor\Actor\RepositoryJsonColumns::ACTOR_PROPERTY_KEY_NAME => $property->getName(),
                AnnotationProcessor\Actor\RepositoryJsonColumns::ACTOR_PROPERTY_KEY_DATA_TYPE => $property->getDataType()
            ];
        }

        return [
            AnnotationProcessor\Actor\RepositoryJsonColumns::STATIC_CONTEXT_RECORD_KEY_PROPERTIES => $staticContextRecord,
            AnnotationProcessor\Actor\RepositoryJsonColumns::STATIC_CONTEXT_RECORD_KEY_VENDOR => $this->getBuildConfiguration()->getVendorName(),
        ];
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

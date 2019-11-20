<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\RepositoryUpdateElementMethod;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryUpdateElementMethod;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\DaoPropertyInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $buildConfiguration = $this->getBuildConfiguration();
        $staticContextRecord = [];

        foreach ($buildConfiguration->getDaoPropertyMap() as $property) {
            $staticContextRecord[] = [
                RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_NAME => $property->getName(),
                RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE => $property->getDataType(),
                RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_NULLABLE => $property->getNullable(),
                RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_CREATED_ON_INSERT => $property->getCreatedOnInsert()
            ];
        }

        return [
            RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_PROPERTIES => $staticContextRecord,
            RepositoryUpdateElementMethod::STATIC_CONTEXT_RECORD_KEY_VENDOR => $this->getBuildConfiguration()->getVendorName()
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

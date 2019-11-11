<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\RepositoryInsertElementMethod;

use Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInsertElementMethod;
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
                RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_NAME => $property->getName(),
                RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_DATA_TYPE => $property->getDataType(),
                RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_NULLABLE => $property->getNullable(),
                RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_CREATED_ON_INSERT => $property->getCreatedOnInsert()
            ];
        }

        return [
            RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_PROPERTIES => $staticContextRecord,
            RepositoryInsertElementMethod::STATIC_CONTEXT_RECORD_KEY_VENDOR => $this->getBuildConfiguration()->getVendorName()
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

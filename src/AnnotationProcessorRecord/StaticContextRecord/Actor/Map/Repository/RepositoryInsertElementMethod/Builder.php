<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\RepositoryInsertElementMethod;

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

        /** @var DaoPropertyInterface $property */
        foreach ($buildConfiguration->getDaoProperties() as $property) {
            $staticContextRecord[] = [
                'name' => $property->getName(),
                'data_type' => $property->getDataType(),
                'created_on_insert' => $property->getCreatedOnInsert(),
                'nullable' => $property->getNullable(),
            ];
        }

        return ['properties' => $staticContextRecord];
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

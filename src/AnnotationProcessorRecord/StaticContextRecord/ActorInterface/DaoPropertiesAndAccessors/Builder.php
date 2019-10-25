<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors;

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
                'type' => $property->getDataType()
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

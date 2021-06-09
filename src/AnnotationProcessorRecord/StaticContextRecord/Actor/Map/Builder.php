<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;
use Neighborhoods\Prefab\AnnotationProcessor;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $buildConfiguration = $this->getBuildConfiguration();

        return [
            AnnotationProcessor\Actor\MapInterfaceJsonSerializable::STATIC_CONTEXT_RECORD_KEY_SERIALIZES_AS_ARRAY => $buildConfiguration->getJsonSerializeMapAsArray(),
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

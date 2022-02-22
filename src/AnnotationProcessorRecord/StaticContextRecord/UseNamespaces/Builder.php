<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\UseNamespaces;

use Neighborhoods\Prefab\AnnotationProcessor\UseNamespaces;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $buildConfiguration = $this->getBuildConfiguration();
        $staticContextRecord = [];
        $namespaces = [];

        $hasDeprecation = false;
        foreach ($buildConfiguration->getDaoPropertyMap() as $property) {
            if ($property->getDeprecated()) {
                $hasDeprecation = true;
            }
        }

        if ($hasDeprecation) {
            // `require JetBrains/phpstorm-stubs` & use Deprecated::class instead?
            $namespaces[] = 'JetBrains\\PhpStorm\\Deprecated';
        }

        if (!empty($namespaces)) {
            $staticContextRecord[UseNamespaces::CONTEXT_KEY_USES] = $namespaces;
        }

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

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\Handler\ProjectNamespaceHttpMessage;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessor;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;
    public const CONTEXT_KEY_NAMESPACE = 'namespace';
    public const CONTEXT_KEY_PROJECT_NAME = 'project_name';

    public function build() : array
    {
        $namespace = 'use \\' . $this->getBuildConfiguration()->getVendorName() . '\PROJECTNAME\Prefab5\Psr\Http\Message\ServerRequest\AwareTrait;';

        return [
            self::CONTEXT_KEY_PROJECT_NAME => $this->getBuildConfiguration()->getProjectName(),
            self::CONTEXT_KEY_NAMESPACE => $namespace,
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

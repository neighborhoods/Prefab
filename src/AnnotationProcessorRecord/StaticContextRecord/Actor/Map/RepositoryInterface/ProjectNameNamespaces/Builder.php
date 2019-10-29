<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\RepositoryInterface\ProjectNameNamespaces;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;
    public const CONTEXT_KEY_NAMESPACE = 'namespaces';
    public const CONTEXT_KEY_PROJECT_NAME = 'project_name';

    public function build() : array
    {
        $namespaces = [
            'Neighborhoods\PROJECTNAME\Prefab5\SearchCriteriaInterface',
        ];

        return [
            self::CONTEXT_KEY_PROJECT_NAME => $this->getBuildConfiguration()->getProjectName(),
            self::CONTEXT_KEY_NAMESPACE => $namespaces,
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

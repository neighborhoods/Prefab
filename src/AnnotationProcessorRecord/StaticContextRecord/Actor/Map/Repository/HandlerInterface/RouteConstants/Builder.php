<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\Map\Repository\HandlerInterface\RouteConstants;

use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessor;
use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\BuilderInterface;

class Builder implements BuilderInterface
{
    protected $buildConfiguration;

    public function build() : array
    {
        $staticContextRecord = [];
        if ($this->getBuildConfiguration()->hasHttpRoute()) {
            $staticContextRecord = [
                AnnotationProcessor\Actor\Repository\HandlerInterface::CONTEXT_KEY_ROUTE_NAME => $this->getRouteNameForDao(),
                AnnotationProcessor\Actor\Repository\HandlerInterface::CONTEXT_KEY_ROUTE_PATH => $this->getBuildConfiguration()->getHttpRoute(),
            ];
        }

        return $staticContextRecord;
    }

    // TODO: Explicitly set this in the build configuration rather than inferring it from here
    protected function getRouteNameForDao() : string
    {
        $filePath = $this->getBuildConfiguration()->getRootSaveLocation();
        $filePath = str_replace(BuildConfigurationInterface::PREFAB_DEFINITION_FILE_EXTENSION, '', $filePath);
        $routeNameArray = explode('/fab/', $filePath);

        if (!isset($routeNameArray[1])) {
            throw new \LogicException('Could not determine valid route name from path ' . $this->getBuildConfiguration()->getRootSaveLocation());
        }

        $routeName = str_replace('/', '', $routeNameArray[1]);
        return strtoupper($routeName);
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

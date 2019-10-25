<?php

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\ActorInterface\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecordInterface;
use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : array;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

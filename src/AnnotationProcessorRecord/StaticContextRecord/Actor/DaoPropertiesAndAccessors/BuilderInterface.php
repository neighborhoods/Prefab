<?php

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord\Actor\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : array;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

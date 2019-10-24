<?php

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : AnnotationProcessorRecordInterface;

    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

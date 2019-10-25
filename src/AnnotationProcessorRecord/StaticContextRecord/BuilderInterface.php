<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\StaticContextRecord;

use Neighborhoods\Prefab\BuildConfigurationInterface;

interface BuilderInterface
{
    public function build() : array;
    public function setBuildConfiguration(BuildConfigurationInterface $buildConfiguration) : BuilderInterface;
}

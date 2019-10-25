<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

use Neighborhoods\Prefab\AnnotationProcessor;
use Neighborhoods\Prefab\AnnotationProcessorRecordInterface;
use Neighborhoods\Prefab\BuildConfigurationInterface;
use Neighborhoods\Prefab\AnnotationProcessorRecord;
use Neighborhoods\Prefab\DaoPropertyInterface;

class Builder implements BuilderInterface
{
    use AnnotationProcessorRecord\Factory\AwareTrait;

    protected $buildConfiguration;
    protected $staticContextRecordBuilder;

    public function build() : AnnotationProcessorRecordInterface
    {
        /** @var AnnotationProcessorRecordInterface $annotationProcessorRecord */
        $annotationProcessorRecord = $this-$this->getAnnotationProcessorRecordFactory()->create();

        $buildConfiguration = $this->getBuildConfiguration();

        $staticContextRecord = [];

        /** @var DaoPropertyInterface $property */
        foreach ($buildConfiguration->getDaoProperties() as $property) {
            $staticContextRecord[] = [
                'name' => $property->getName(),
                'type' => $property->getDataType()
            ];
        }

        $annotationProcessorRecord->setProcessorFullyQualifiedClassname(AnnotationProcessor\DAO::class);
        $annotationProcessorRecord->setStaticContextRecord($staticContextRecord);

        return $annotationProcessorRecord;
    }

    public function getStaticContextRecordBuilder() : BuildConfigurationInterface
    {
        if ($this->buildConfiguration === null) {
            throw new \LogicException('Builder buildConfiguration has not been set.');
        }
        return $this->buildConfiguration;
    }

    public function setStaticContextRecordBuilder(BuildConfigurationInterface $buildConfiguration) : BuilderInterface
    {
        if ($this->buildConfiguration !== null) {
            throw new \LogicException('Builder buildConfiguration is already set.');
        }
        $this->buildConfiguration = $buildConfiguration;
        return $this;
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

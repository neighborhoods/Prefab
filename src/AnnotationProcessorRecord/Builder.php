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
    protected $annotationProcessorKey;
    protected $processorFullyQualifiedClassname;

    public function build() : AnnotationProcessorRecordInterface
    {
        /** @var AnnotationProcessorRecordInterface $annotationProcessorRecord */
        $annotationProcessorRecord = $this->getAnnotationProcessorRecordFactory()->create();

        $staticContextRecord = $this->getStaticContextRecordBuilder()
            ->setBuildConfiguration($this->getBuildConfiguration())
            ->build();

        if (!empty($staticContextRecord)) {
            $annotationProcessorRecord->setAnnotationProcessorKey($this->getAnnotationProcessorKey());
            $annotationProcessorRecord->setProcessorFullyQualifiedClassname($this->getProcessorFullyQualifiedClassname());
            $annotationProcessorRecord->setStaticContextRecord($staticContextRecord);
        }

        return $annotationProcessorRecord;
    }

    protected function getStaticContextRecordBuilder() : StaticContextRecord\BuilderInterface
    {
        if ($this->staticContextRecordBuilder === null) {
            throw new \LogicException('Builder buildConfiguration has not been set.');
        }
        return $this->staticContextRecordBuilder;
    }

    public function setStaticContextRecordBuilder(StaticContextRecord\BuilderInterface $staticContextRecordBuilder) : BuilderInterface
    {
        if ($this->staticContextRecordBuilder !== null) {
            throw new \LogicException('Builder buildConfiguration is already set.');
        }
        $this->staticContextRecordBuilder = $staticContextRecordBuilder;
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

    protected function getAnnotationProcessorKey() : string
    {
        if ($this->annotationProcessorKey === null) {
            throw new \LogicException('Builder annotationProcessorKey has not been set.');
        }
        return $this->annotationProcessorKey;
    }

    public function setAnnotationProcessorKey(string $annotationProcessorKey) : BuilderInterface
    {
        if ($this->annotationProcessorKey !== null) {
            throw new \LogicException('Builder annotationProcessorKey is already set.');
        }
        $this->annotationProcessorKey = $annotationProcessorKey;
        return $this;
    }

    protected function getProcessorFullyQualifiedClassname() : string
    {
        if ($this->processorFullyQualifiedClassname === null) {
            throw new \LogicException('Builder processorFullyQualifiedClassname has not been set.');
        }
        return $this->processorFullyQualifiedClassname;
    }

    public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname) : BuilderInterface
    {
        if ($this->processorFullyQualifiedClassname !== null) {
            throw new \LogicException('Builder processorFullyQualifiedClassname is already set.');
        }
        $this->processorFullyQualifiedClassname = $processorFullyQualifiedClassname;
        return $this;
    }
}

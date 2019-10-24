<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors\Builder\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors\Builder\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory;

    public function setAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory(FactoryInterface $DaoPropertiesAndAccessorsBuilderFactory): self
    {
        if ($this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory is already set.');
        }
        $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory = $DaoPropertiesAndAccessorsBuilderFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory is not set.');
        }

        return $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory;
    }

    protected function hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory);
    }

    protected function unsetAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsBuilderFactory);

        return $this;
    }
}

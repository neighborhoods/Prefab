<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors\Factory;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors\FactoryInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory;

    public function setAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory(FactoryInterface $DaoPropertiesAndAccessorsFactory): self
    {
        if ($this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory is already set.');
        }
        $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory = $DaoPropertiesAndAccessorsFactory;

        return $this;
    }

    protected function getAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory(): FactoryInterface
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory is not set.');
        }

        return $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory;
    }

    protected function hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory(): bool
    {
        return isset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory);
    }

    protected function unsetAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory(): self
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory is not set.');
        }
        unset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessorsFactory);

        return $this;
    }
}

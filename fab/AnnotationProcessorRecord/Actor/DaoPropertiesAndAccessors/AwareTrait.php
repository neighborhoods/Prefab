<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessors;

use Neighborhoods\Prefab\AnnotationProcessorRecord\Actor\DaoPropertiesAndAccessorsInterface;

trait AwareTrait
{
    protected $AnnotationProcessorRecordActorDaoPropertiesAndAccessors;

    public function setAnnotationProcessorRecordActorDaoPropertiesAndAccessors(DaoPropertiesAndAccessorsInterface $DaoPropertiesAndAccessors): self
    {
        if ($this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessors()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessors is already set.');
        }
        $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessors = $DaoPropertiesAndAccessors;

        return $this;
    }

    protected function getAnnotationProcessorRecordActorDaoPropertiesAndAccessors(): DaoPropertiesAndAccessorsInterface
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessors()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessors is not set.');
        }

        return $this->AnnotationProcessorRecordActorDaoPropertiesAndAccessors;
    }

    protected function hasAnnotationProcessorRecordActorDaoPropertiesAndAccessors(): bool
    {
        return isset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessors);
    }

    protected function unsetAnnotationProcessorRecordActorDaoPropertiesAndAccessors(): self
    {
        if (!$this->hasAnnotationProcessorRecordActorDaoPropertiesAndAccessors()) {
            throw new \LogicException('AnnotationProcessorRecordActorDaoPropertiesAndAccessors is not set.');
        }
        unset($this->AnnotationProcessorRecordActorDaoPropertiesAndAccessors);

        return $this;
    }
}

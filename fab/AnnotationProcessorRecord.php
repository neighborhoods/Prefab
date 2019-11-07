<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class AnnotationProcessorRecord implements AnnotationProcessorRecordInterface
{
    /** @var string */
    private $processorFullyQualifiedClassname;

    /** @var array */
    private $staticContextRecord;

    /** @var string */
    private $annotationProcessorKey;

     public function getProcessorFullyQualifiedClassname(): string
     {
         if ($this->processorFullyQualifiedClassname === null) {
             throw new \LogicException('processorFullyQualifiedClassname has not been set');
         }
         
         return $this->processorFullyQualifiedClassname;
     }
     
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorRecordInterface
     {
         if ($this->processorFullyQualifiedClassname !== null) {
             throw new \LogicException('processorFullyQualifiedClassname has already been set');
         }
         
         $this->processorFullyQualifiedClassname = $processorFullyQualifiedClassname;
         return $this;
     }
     
     public function hasProcessorFullyQualifiedClassname(): bool
     {
        return $this->processorFullyQualifiedClassname !== null;
     }
     

     public function getStaticContextRecord(): array
     {
         if ($this->staticContextRecord === null) {
             throw new \LogicException('staticContextRecord has not been set');
         }
         
         return $this->staticContextRecord;
     }
     
     public function setStaticContextRecord(array $staticContextRecord): AnnotationProcessorRecordInterface
     {
         if ($this->staticContextRecord !== null) {
             throw new \LogicException('staticContextRecord has already been set');
         }
         
         $this->staticContextRecord = $staticContextRecord;
         return $this;
     }
     
     public function hasStaticContextRecord(): bool
     {
        return $this->staticContextRecord !== null;
     }
     

     public function getAnnotationProcessorKey(): string
     {
         if ($this->annotationProcessorKey === null) {
             throw new \LogicException('annotationProcessorKey has not been set');
         }
         
         return $this->annotationProcessorKey;
     }
     
     public function setAnnotationProcessorKey(string $annotationProcessorKey): AnnotationProcessorRecordInterface
     {
         if ($this->annotationProcessorKey !== null) {
             throw new \LogicException('annotationProcessorKey has already been set');
         }
         
         $this->annotationProcessorKey = $annotationProcessorKey;
         return $this;
     }
     
     public function hasAnnotationProcessorKey(): bool
     {
        return $this->annotationProcessorKey !== null;
     }
     

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

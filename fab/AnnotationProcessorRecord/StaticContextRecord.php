<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

class StaticContextRecord implements StaticContextRecordInterface
{
    /** @var string */
    private $processorFullyQualifiedClassname;

    /** @var array */
    private $staticContextRecord;

     public function getProcessorFullyQualifiedClassname(): string
     {
         if ($this->processorFullyQualifiedClassname === null) {
             throw new \LogicException('processorFullyQualifiedClassname has not been set');
         }
         
         return $this->processorFullyQualifiedClassname;
     }
     
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): StaticContextRecordInterface
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
     
     public function setStaticContextRecord(array $staticContextRecord): StaticContextRecordInterface
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
     

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

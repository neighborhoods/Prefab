<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AnnotationProcessorRecord;

class StaticContextRecord implements StaticContextRecordInterface
{
    /** @var string */
    private $processorFullyQualifiedClassname;

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
     

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

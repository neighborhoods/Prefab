<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class AnnotationProcessorRecord implements AnnotationProcessorRecordInterface
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
     
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorRecordInterface
     {
         if ($this->processorFullyQualifiedClassname !== null) {
             throw new \LogicException('processorFullyQualifiedClassname has already been set');
         }
         
         $this->processorFullyQualifiedClassname = $processorFullyQualifiedClassname;
         
         return $this;
     }
}

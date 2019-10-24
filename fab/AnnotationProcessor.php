<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class AnnotationProcessor implements AnnotationProcessorInterface
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
     
     public function setProcessorFullyQualifiedClassname(string $processorFullyQualifiedClassname): AnnotationProcessorInterface
     {
         if ($this->processorFullyQualifiedClassname !== null) {
             throw new \LogicException('processorFullyQualifiedClassname has already been set');
         }
         
         $this->processorFullyQualifiedClassname = $processorFullyQualifiedClassname;
         
         return $this;
     }

     public function getStaticContextRecord(): array
     {
         if ($this->staticContextRecord === null) {
             throw new \LogicException('staticContextRecord has not been set');
         }
         
         return $this->staticContextRecord;
     }
     
     public function setStaticContextRecord(array $staticContextRecord): AnnotationProcessorInterface
     {
         if ($this->staticContextRecord !== null) {
             throw new \LogicException('staticContextRecord has already been set');
         }
         
         $this->staticContextRecord = $staticContextRecord;
         
         return $this;
     }
}

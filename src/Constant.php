<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class Constant implements ConstantInterface
{
    /** @var string */
    private $name;

    private $value;

     public function getName(): string
     {
         if ($this->name === null) {
             throw new \LogicException('name has not been set');
         }
         
         return $this->name;
     }
     
     public function setName(string $name): ConstantInterface
     {
         if ($this->name !== null) {
             throw new \LogicException('name has already been set');
         }
         
         $this->name = $name;
         return $this;
     }
     
     public function hasName(): bool
     {
        return $this->name !== null;
     }
     

     public function getValue()
     {
         if ($this->value === null) {
             throw new \LogicException('value has not been set');
         }
         
         return $this->value;
     }
     
     public function setValue($value): ConstantInterface
     {
         if ($this->value !== null) {
             throw new \LogicException('value has already been set');
         }
         
         $this->value = $value;
         return $this;
     }
     
     public function hasValue(): bool
     {
        return $this->value !== null;
     }
     

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

class DaoProperty implements DaoPropertyInterface
{
    /** @var string */
    private $name;

    /** @var string */
    private $dataType;

    /** @var bool */
    private $nullable;

    /** @var string */
    private $recordKey;

    /** @var bool */
    private $createdOnInsert;

    /** @var bool */
    private $deprecated;

    /** @var string */
    private $deprecated_message;

    /** @var string */
    private $replacement;

     public function getName(): string
     {
         if ($this->name === null) {
             throw new \LogicException('name has not been set');
         }
         
         return $this->name;
     }
     
     public function setName(string $name): DaoPropertyInterface
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
     

     public function getDataType(): string
     {
         if ($this->dataType === null) {
             throw new \LogicException('dataType has not been set');
         }
         
         return $this->dataType;
     }
     
     public function setDataType(string $dataType): DaoPropertyInterface
     {
         if ($this->dataType !== null) {
             throw new \LogicException('dataType has already been set');
         }
         
         $this->dataType = $dataType;
         return $this;
     }
     
     public function hasDataType(): bool
     {
        return $this->dataType !== null;
     }
     

     public function getNullable(): bool
     {
         if ($this->nullable === null) {
             throw new \LogicException('nullable has not been set');
         }
         
         return $this->nullable;
     }
     
     public function setNullable(bool $nullable): DaoPropertyInterface
     {
         if ($this->nullable !== null) {
             throw new \LogicException('nullable has already been set');
         }
         
         $this->nullable = $nullable;
         return $this;
     }
     
     public function hasNullable(): bool
     {
        return $this->nullable !== null;
     }
     

     public function getRecordKey(): string
     {
         if ($this->recordKey === null) {
             throw new \LogicException('recordKey has not been set');
         }
         
         return $this->recordKey;
     }
     
     public function setRecordKey(string $recordKey): DaoPropertyInterface
     {
         if ($this->recordKey !== null) {
             throw new \LogicException('recordKey has already been set');
         }
         
         $this->recordKey = $recordKey;
         return $this;
     }
     
     public function hasRecordKey(): bool
     {
        return $this->recordKey !== null;
     }
     

     public function getCreatedOnInsert(): bool
     {
         if ($this->createdOnInsert === null) {
             throw new \LogicException('createdOnInsert has not been set');
         }
         
         return $this->createdOnInsert;
     }
     
     public function setCreatedOnInsert(bool $createdOnInsert): DaoPropertyInterface
     {
         if ($this->createdOnInsert !== null) {
             throw new \LogicException('createdOnInsert has already been set');
         }
         
         $this->createdOnInsert = $createdOnInsert;
         return $this;
     }
     
     public function hasCreatedOnInsert(): bool
     {
        return $this->createdOnInsert !== null;
     }
     

     public function getDeprecated(): bool
     {
         if ($this->deprecated === null) {
             throw new \LogicException('deprecated has not been set');
         }
         
         return $this->deprecated;
     }
     
     public function setDeprecated(bool $deprecated): DaoPropertyInterface
     {
         if ($this->deprecated !== null) {
             throw new \LogicException('deprecated has already been set');
         }
         
         $this->deprecated = $deprecated;
         return $this;
     }
     
     public function hasDeprecated(): bool
     {
        return $this->deprecated !== null;
     }
     

     public function getDeprecatedMessage(): string
     {
         if ($this->deprecated_message === null) {
             throw new \LogicException('deprecated_message has not been set');
         }
         
         return $this->deprecated_message;
     }
     
     public function setDeprecatedMessage(string $deprecated_message): DaoPropertyInterface
     {
         if ($this->deprecated_message !== null) {
             throw new \LogicException('deprecated_message has already been set');
         }
         
         $this->deprecated_message = $deprecated_message;
         return $this;
     }
     
     public function hasDeprecatedMessage(): bool
     {
        return $this->deprecated_message !== null;
     }
     

     public function getReplacement(): string
     {
         if ($this->replacement === null) {
             throw new \LogicException('replacement has not been set');
         }
         
         return $this->replacement;
     }
     
     public function setReplacement(string $replacement): DaoPropertyInterface
     {
         if ($this->replacement !== null) {
             throw new \LogicException('replacement has already been set');
         }
         
         $this->replacement = $replacement;
         return $this;
     }
     
     public function hasReplacement(): bool
     {
        return $this->replacement !== null;
     }
     

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

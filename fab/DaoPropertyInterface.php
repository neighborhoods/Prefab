<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface DaoPropertyInterface
{
     public function getName(): string;
     public function setName(string $name): DaoPropertyInterface;

     public function getDataType(): string;
     public function setDataType(string $dataType): DaoPropertyInterface;

     public function getNullable(): bool;
     public function setNullable(bool $nullable): DaoPropertyInterface;

     public function getRecordKey(): string;
     public function setRecordKey(string $recordKey): DaoPropertyInterface;

     public function getCreatedOnInsert(): bool;
     public function setCreatedOnInsert(bool $createdOnInsert): DaoPropertyInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab;

interface DaoPropertyInterface extends \JsonSerializable
{


    public function getName(): string;
    public function setName(string $name): DaoPropertyInterface;
    public function hasName(): bool;

    public function getDataType(): string;
    public function setDataType(string $dataType): DaoPropertyInterface;
    public function hasDataType(): bool;

    public function getNullable(): bool;
    public function setNullable(bool $nullable): DaoPropertyInterface;
    public function hasNullable(): bool;

    public function getRecordKey(): string;
    public function setRecordKey(string $recordKey): DaoPropertyInterface;
    public function hasRecordKey(): bool;

    public function getCreatedOnInsert(): bool;
    public function setCreatedOnInsert(bool $createdOnInsert): DaoPropertyInterface;
    public function hasCreatedOnInsert(): bool;
}

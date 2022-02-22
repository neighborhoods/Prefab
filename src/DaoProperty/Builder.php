<?php

declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    protected $record;

    public function build(): DaoPropertyInterface
    {
        $daoproperty = $this->getDaoPropertyFactory()->create();
        $record = $this->getRecord();

        $daoproperty->setName($record['name']);
        $daoproperty->setDataType($record['data_type'] ?? $record['php_type']);

        $daoproperty->setNullable($record['nullable'] ?? false);
        $daoproperty->setRecordKey($record['record_key'] ?? $record['database_column_name']);
        $daoproperty->setCreatedOnInsert($record['created_on_insert'] ?? false);

        $daoproperty->setIsDeprecated($record['is_deprecated'] ?? false);
        $daoproperty->setDeprecatedMessage($record['deprecated_message'] ?? '');
        $daoproperty->setReplacement($record['replacement'] ?? '');
        if (!$daoproperty->getIsDeprecated() && $daoproperty->getDeprecatedMessage() !== '') {
            throw new \UnexpectedValueException(
                "deprecated_message '{$daoproperty->getDeprecatedMessage()}' is set for a non-deprecated property"
            );
        }
        if (!$daoproperty->getIsDeprecated() && $daoproperty->getReplacement() !== '') {
            throw new \UnexpectedValueException(
                "replacement '{$daoproperty->getReplacement()}' is set for a non-deprecated property"
            );
        }

        return $daoproperty;
    }

    protected function getRecord(): array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record): BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}

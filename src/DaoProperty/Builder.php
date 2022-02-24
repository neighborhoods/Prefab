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
        $daoproperty->setRecordKey($record['record_key'] ?? $record['database_column_name'] ?? $record['name']);
        $daoproperty->setCreatedOnInsert($record['created_on_insert'] ?? false);

        $daoproperty->setIsDeprecated($record['is_deprecated'] ?? false);

        if (!empty($record['deprecated_message'])) { // allow for empty or null in the prefab file
            $daoproperty->setDeprecatedMessage($record['deprecated_message']);
        }

        if (!empty($record['replacement'])) { // allow for empty or null in the prefab filet status
            $daoproperty->setReplacement($record['replacement']);
        }

        $this->validateDaoProperty($daoproperty);

        return $daoproperty;
    }

    private function validateDaoProperty(DaoPropertyInterface $daoProperty): void
    {
        if (!$daoProperty->getIsDeprecated()) {
            if ($daoProperty->hasDeprecatedMessage()) {
                throw new \UnexpectedValueException(
                    "deprecated_message '{$daoProperty->getDeprecatedMessage()}' is set for a non-deprecated property"
                );
            }

            if ($daoProperty->hasReplacement()) {
                throw new \UnexpectedValueException(
                    "replacement '{$daoProperty->getReplacement()}' is set for a non-deprecated property"
                );
            }
        }
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

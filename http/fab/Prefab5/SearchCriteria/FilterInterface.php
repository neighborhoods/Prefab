<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

interface FilterInterface extends \JsonSerializable
{

    public function getField(): string;

    public function setField(string $field): FilterInterface;

    public function getValues(): array;

    public function setValues(array $values): FilterInterface;

    public function getCondition(): string;

    public function setCondition(string $condition): FilterInterface;

    public function getGlue(): string;

    public function setGlue(string $glue): FilterInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria;

interface SortOrderInterface extends \JsonSerializable
{
    public function getField(): string;

    public function setField(string $field): SortOrderInterface;

    public function getDirection(): string;

    public function setDirection(string $direction): SortOrderInterface;
}
<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\SortOrder\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

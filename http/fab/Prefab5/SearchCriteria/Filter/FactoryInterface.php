<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Filter;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\FilterInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): FilterInterface;
}

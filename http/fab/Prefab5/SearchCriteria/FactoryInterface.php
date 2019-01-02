<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteriaInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SearchCriteriaInterface;
}

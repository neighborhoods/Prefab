<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteriaInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): SearchCriteriaInterface;
}

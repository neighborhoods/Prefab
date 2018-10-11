<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Filter\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

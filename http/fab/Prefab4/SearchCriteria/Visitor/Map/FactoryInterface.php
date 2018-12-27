<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Visitor\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\SearchCriteria\Visitor\MapInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): MapInterface;
}

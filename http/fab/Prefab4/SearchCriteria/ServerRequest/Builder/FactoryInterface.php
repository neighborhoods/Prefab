<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}

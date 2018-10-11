<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}

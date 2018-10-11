<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\Builder;

use Neighborhoods\PrefabExamplesFunction41\SearchCriteria\ServerRequest\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}

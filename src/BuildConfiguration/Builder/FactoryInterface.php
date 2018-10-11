<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Builder;

use Neighborhoods\Prefab\BuildConfiguration\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}

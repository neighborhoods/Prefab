<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\RepositoryInterface\Generator;

use Neighborhoods\Prefab\RepositoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

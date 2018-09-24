<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface\Generator;

use Neighborhoods\Prefab\Actor\RepositoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

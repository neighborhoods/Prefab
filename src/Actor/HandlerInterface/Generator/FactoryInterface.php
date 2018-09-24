<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator;

use Neighborhoods\Prefab\Actor\HandlerInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

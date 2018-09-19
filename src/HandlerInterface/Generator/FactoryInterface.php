<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HandlerInterface\Generator;

use Neighborhoods\Prefab\HandlerInterface\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

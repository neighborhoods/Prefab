<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Generator;

use Neighborhoods\Prefab\AwareTrait\GeneratorInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : GeneratorInterface;
}

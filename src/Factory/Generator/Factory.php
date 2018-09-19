<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getFactoryGenerator();
    }
}

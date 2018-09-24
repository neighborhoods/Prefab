<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\FactoryInterface\Generator;

use Neighborhoods\Prefab\Actor\FactoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getFactoryInterfaceGenerator();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Generator;

use Neighborhoods\Prefab\FactoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getFactoryInterfaceGenerator();
    }
}

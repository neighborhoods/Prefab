<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuilderInterface\Generator;

use Neighborhoods\Prefab\BuilderInterface\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getBuilderInterfaceGenerator();
    }
}

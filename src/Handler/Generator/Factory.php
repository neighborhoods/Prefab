<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Handler\Generator;

use Neighborhoods\Prefab\Handler\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getHandlerGenerator();
    }
}

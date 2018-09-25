<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\HandlerInterface\Generator;

use Neighborhoods\Prefab\Console\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): GeneratorInterface
    {
        return clone $this->getActorHandlerInterfaceGenerator();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface\Generator;

use Neighborhoods\Prefab\Actor\RepositoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getRepositoryInterfaceGenerator();
    }
}

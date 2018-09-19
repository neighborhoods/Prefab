<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\RepositoryInterface\Generator;

use Neighborhoods\Prefab\RepositoryInterface\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getRepositoryInterfaceGenerator();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Generator;

use Neighborhoods\Prefab\AwareTrait\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getAwareTraitGenerator();
    }
}

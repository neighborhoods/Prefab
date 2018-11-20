<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\HttpSkeleton\Generator;

use Neighborhoods\Prefab\HttpSkeleton\GeneratorInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : GeneratorInterface
    {
        return clone $this->getHttpSkeletonGenerator();
    }
}

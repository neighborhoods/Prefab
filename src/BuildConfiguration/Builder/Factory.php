<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration\Builder;

use Neighborhoods\Prefab\BuildConfiguration\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getBuildConfigurationBuilder();
    }
}

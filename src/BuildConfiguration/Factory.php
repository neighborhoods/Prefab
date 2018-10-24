<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuildConfigurationInterface
    {
        return clone $this->getBuildConfiguration();
    }
}

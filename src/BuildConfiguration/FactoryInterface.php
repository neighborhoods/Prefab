<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuildConfiguration;

use Neighborhoods\Prefab\BuildConfigurationInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuildConfigurationInterface;
}

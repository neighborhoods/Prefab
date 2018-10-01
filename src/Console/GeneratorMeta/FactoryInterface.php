<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console\GeneratorMeta;

use Neighborhoods\Prefab\Console\GeneratorMetaInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): GeneratorMetaInterface;
}

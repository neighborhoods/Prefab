<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Console\GeneratorMeta;

use Neighborhoods\Prefab\Console\GeneratorMetaInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): GeneratorMetaInterface
    {
        return clone $this->getConsoleGeneratorMeta();
    }
}

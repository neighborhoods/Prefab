<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\StringReplacer;

use Neighborhoods\Prefab\StringReplacerInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : StringReplacerInterface
    {
        return clone $this->getStringReplacer();
    }
}

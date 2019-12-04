<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\TokenReplacer;

use Neighborhoods\Prefab\TokenReplacerInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): TokenReplacerInterface
    {
        return clone $this->getTokenReplacer();
    }
}

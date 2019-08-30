<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\FactoryActor;

use Neighborhoods\Prefab\Bradfab\Template\FactoryActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): FactoryActorInterface
    {
        return clone $this->getFactoryActor();
    }
}

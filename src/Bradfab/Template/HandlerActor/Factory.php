<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\HandlerActor;

use Neighborhoods\Prefab\Bradfab\Template\HandlerActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): HandlerActorInterface
    {
        return clone $this->getHandlerActor();
    }
}

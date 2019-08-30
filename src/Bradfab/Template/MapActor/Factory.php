<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapActor;

use Neighborhoods\Prefab\Bradfab\Template\MapActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapActorInterface
    {
        return clone $this->getMapActor();
    }
}

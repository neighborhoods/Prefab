<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor;

use Neighborhoods\Prefab\ActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): ActorInterface
    {
        return clone $this->getActor();
    }
}

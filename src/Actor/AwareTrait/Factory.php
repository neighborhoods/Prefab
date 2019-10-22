<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait;

use Neighborhoods\Prefab\Actor;
use Neighborhoods\Prefab\ActorInterface;

class Factory implements FactoryInterface
{
    use Actor\AwareTrait;

    public function create(): ActorInterface
    {
        return clone $this->getActor();
    }
}

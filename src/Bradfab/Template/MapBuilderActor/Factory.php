<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\MapBuilderActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapBuilderActorInterface
    {
        return clone $this->getMapBuilderActor();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActors;

use Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActorsInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): AllSupportingActorsInterface
    {
        return clone $this->getAllSupportingActors();
    }
}

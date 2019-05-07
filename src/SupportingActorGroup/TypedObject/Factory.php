<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\TypedObject;

use Neighborhoods\Prefab\SupportingActorGroup\TypedObjectInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): TypedObjectInterface
    {
        return clone $this->getTypedObject();
    }
}

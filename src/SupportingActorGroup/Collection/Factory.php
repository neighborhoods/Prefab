<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Collection;

use Neighborhoods\Prefab\SupportingActorGroup\CollectionInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): CollectionInterface
    {
        return clone $this->getCollection();
    }
}

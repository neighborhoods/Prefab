<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Minimal;

use Neighborhoods\Prefab\SupportingActorGroup\MinimalInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MinimalInterface
    {
        return clone $this->getMinimal();
    }
}

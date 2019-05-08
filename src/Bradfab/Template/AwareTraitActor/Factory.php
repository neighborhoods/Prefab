<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor;

use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): AwareTraitActorInterface
    {
        return clone $this->getAwareTraitActor();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\BuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\BuilderActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderActorInterface
    {
        return clone $this->getBuilderActor();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\RepositoryActor;

use Neighborhoods\Prefab\Bradfab\Template\RepositoryActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): RepositoryActorInterface
    {
        return clone $this->getRepositoryActor();
    }
}

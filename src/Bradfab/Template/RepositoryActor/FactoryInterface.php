<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\RepositoryActor;

use Neighborhoods\Prefab\Bradfab\Template\RepositoryActorInterface;

interface FactoryInterface
{
    public function create(): RepositoryActorInterface;
}

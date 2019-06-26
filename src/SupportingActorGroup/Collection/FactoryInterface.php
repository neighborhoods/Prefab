<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Collection;

use Neighborhoods\Prefab\SupportingActorGroup\CollectionInterface;

interface FactoryInterface
{
    public function create(): CollectionInterface;
}

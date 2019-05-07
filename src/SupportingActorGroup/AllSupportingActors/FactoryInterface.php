<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActors;

use Neighborhoods\Prefab\SupportingActorGroup\AllSupportingActorsInterface;

interface FactoryInterface
{
    public function create(): AllSupportingActorsInterface;
}

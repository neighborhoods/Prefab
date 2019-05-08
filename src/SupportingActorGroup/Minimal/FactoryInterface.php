<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\Minimal;

use Neighborhoods\Prefab\SupportingActorGroup\MinimalInterface;

interface FactoryInterface
{
    public function create(): MinimalInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\SupportingActorGroup\TypedObject;

use Neighborhoods\Prefab\SupportingActorGroup\TypedObjectInterface;

interface FactoryInterface
{
    public function create(): TypedObjectInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapActor;

use Neighborhoods\Prefab\Bradfab\Template\MapActorInterface;

interface FactoryInterface
{
    public function create(): MapActorInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\FactoryActor;

use Neighborhoods\Prefab\Bradfab\Template\FactoryActorInterface;

interface FactoryInterface
{
    public function create(): FactoryActorInterface;
}

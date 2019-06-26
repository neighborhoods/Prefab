<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\MapBuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\MapBuilderActorInterface;

interface FactoryInterface
{
    public function create(): MapBuilderActorInterface;
}

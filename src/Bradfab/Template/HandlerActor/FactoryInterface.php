<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\HandlerActor;

use Neighborhoods\Prefab\Bradfab\Template\HandlerActorInterface;

interface FactoryInterface
{
    public function create(): HandlerActorInterface;
}

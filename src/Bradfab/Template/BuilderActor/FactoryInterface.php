<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\BuilderActor;

use Neighborhoods\Prefab\Bradfab\Template\BuilderActorInterface;

interface FactoryInterface
{
    public function create(): BuilderActorInterface;
}

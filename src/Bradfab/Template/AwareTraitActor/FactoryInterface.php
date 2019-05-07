<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template\AwareTraitActor;

use Neighborhoods\Prefab\Bradfab\Template\AwareTraitActorInterface;

interface FactoryInterface
{
    public function create(): AwareTraitActorInterface;
}

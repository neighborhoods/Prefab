<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait;

use Neighborhoods\Prefab\ActorInterface;

interface FactoryInterface
{
    public function create(): ActorInterface;
}

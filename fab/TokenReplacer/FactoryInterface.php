<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\TokenReplacer;

use Neighborhoods\Prefab\TokenReplacerInterface;

interface FactoryInterface
{
    public function create(): TokenReplacerInterface;
}

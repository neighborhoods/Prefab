<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Builder;

use Neighborhoods\Prefab\DaoProperty\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

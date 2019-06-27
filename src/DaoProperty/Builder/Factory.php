<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Builder;

use Neighborhoods\Prefab\DaoProperty\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getDaoPropertyBuilder();
    }
}

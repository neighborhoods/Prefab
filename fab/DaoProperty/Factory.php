<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): DaoPropertyInterface
    {
        return clone $this->getDaoProperty();
    }
}

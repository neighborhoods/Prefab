<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\ClassSaver;

use Neighborhoods\Prefab\ClassSaverInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : ClassSaverInterface
    {
        return clone $this->getClassSaver();
    }
}

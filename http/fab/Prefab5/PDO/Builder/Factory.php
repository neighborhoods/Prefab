<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPDOBuilder();
    }
}

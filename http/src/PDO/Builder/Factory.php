<?php
declare(strict_types=1);

namespace Neighborhoods\~~PROJECT NAME~~\PDO\Builder;

use Neighborhoods\~~PROJECT NAME~~\PDO\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPDOBuilder();
    }
}

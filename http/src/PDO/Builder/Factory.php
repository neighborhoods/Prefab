<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\PDO\Builder;

use Neighborhoods\Radar\PDO\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPDOBuilder();
    }
}
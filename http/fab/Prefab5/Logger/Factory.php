<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\LoggerInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : LoggerInterface
    {
        return clone $this->getPrefab5Logger();
    }
}

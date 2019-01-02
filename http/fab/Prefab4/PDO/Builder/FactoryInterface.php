<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\PDO\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}

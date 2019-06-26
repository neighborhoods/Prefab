<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\LoggerInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : LoggerInterface;
}

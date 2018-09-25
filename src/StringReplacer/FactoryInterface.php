<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\StringReplacer;

use Neighborhoods\Prefab\StringReplacerInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : StringReplacerInterface;
}

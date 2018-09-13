<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Template;

use Neighborhoods\Prefab\Factory\Template;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : Template;
}

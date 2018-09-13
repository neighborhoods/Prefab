<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Template;

use Neighborhoods\Prefab\FactoryInterface\Template;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : Template;
}

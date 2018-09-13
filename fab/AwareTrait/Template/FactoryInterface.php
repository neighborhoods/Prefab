<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Template;

use Neighborhoods\Prefab\AwareTrait\Template;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : Template;
}

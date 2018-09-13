<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Factory\Template;

use Neighborhoods\Prefab\Factory\Template;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : Template
    {
        return clone $this->getFactoryTemplate();
    }
}

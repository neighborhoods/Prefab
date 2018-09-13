<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\FactoryInterface\Template;

use Neighborhoods\Prefab\FactoryInterface\Template;

/** @codeCoverageIgnore */
class FactoryInterface implements FactoryInterface
{
    use AwareTrait;

    public function create() : Template
    {
        return clone $this->getFactoryTemplate();
    }
}

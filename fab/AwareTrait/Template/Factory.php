<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\AwareTrait\Template;

use Neighborhoods\Prefab\AwareTrait\Template;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : Template
    {
        return clone $this->getAwareTraitTemplate();
    }
}

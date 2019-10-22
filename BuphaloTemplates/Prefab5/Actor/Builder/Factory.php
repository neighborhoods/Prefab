<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Builder;

use Neighborhoods\Buphalo\Template\Actor\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getActorBuilder();
    }
}

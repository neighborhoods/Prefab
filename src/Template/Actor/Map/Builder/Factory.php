<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map\Builder;

use Neighborhoods\Bradfab\Template\Actor\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getActorMapBuilder();
    }
}

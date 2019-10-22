<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\Actor\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getActorMapBuilder();
    }
}

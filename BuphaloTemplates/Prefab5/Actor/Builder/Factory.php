<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Builder;

use Neighborhoods\BuphaloTemplateTree\Actor\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getActorBuilder();
    }
}

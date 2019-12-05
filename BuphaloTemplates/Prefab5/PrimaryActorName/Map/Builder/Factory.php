<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPrimaryActorNameMapBuilder();
    }
}

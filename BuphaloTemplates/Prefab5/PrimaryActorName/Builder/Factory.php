<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPrimaryActorNameBuilder();
    }
}

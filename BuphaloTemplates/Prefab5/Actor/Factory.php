<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor;

use Neighborhoods\BuphaloTemplateTree\ActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;
    public function create(): ActorInterface
    {
        return clone $this->getActor();
    }
}

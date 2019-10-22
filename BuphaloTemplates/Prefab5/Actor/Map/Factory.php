<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map;

use Neighborhoods\BuphaloTemplateTree\Actor\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getActorMap()->getArrayCopy();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getActorMap()->getArrayCopy();
    }
}

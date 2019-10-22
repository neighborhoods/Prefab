<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Map;

use Neighborhoods\Buphalo\Template\Actor\MapInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getActorMap()->getArrayCopy();
    }
}

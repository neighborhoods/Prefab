<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor;

use Neighborhoods\Buphalo\Template\ActorInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ActorInterface
    {
        return clone $this->getActor();
    }
}

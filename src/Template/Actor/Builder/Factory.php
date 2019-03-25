<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Builder;

use Neighborhoods\Bradfab\Template\Actor\BuilderInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getActorBuilder();
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

use Neighborhoods\Prefab\Bradfab\TemplateInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): TemplateInterface
    {
        return clone $this->getTemplate();
    }
}

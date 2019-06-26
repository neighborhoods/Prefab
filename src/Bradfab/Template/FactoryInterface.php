<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Bradfab\Template;

use Neighborhoods\Prefab\Bradfab\TemplateInterface;

interface FactoryInterface
{
    public function create(): TemplateInterface;
}

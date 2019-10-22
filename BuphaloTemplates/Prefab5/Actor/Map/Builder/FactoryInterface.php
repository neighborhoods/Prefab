<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\Actor\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

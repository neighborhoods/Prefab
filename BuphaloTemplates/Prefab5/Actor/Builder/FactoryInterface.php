<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Builder;

use Neighborhoods\BuphaloTemplateTree\Actor\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

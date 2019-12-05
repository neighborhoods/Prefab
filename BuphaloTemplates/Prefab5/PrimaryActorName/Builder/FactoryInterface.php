<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

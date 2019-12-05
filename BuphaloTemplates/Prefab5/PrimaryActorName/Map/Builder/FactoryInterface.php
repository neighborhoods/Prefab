<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Builder;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

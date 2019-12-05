<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

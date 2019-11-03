<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map;

use Neighborhoods\BuphaloTemplateTree\Actor\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

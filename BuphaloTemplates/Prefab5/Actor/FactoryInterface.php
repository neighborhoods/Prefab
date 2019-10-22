<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor;

use Neighborhoods\BuphaloTemplateTree\ActorInterface;

interface FactoryInterface
{
    public function create(): ActorInterface;
}

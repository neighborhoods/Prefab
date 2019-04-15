<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

interface FactoryInterface
{
    public function create(): ActorInterface;
}

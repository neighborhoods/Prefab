<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor;

use Neighborhoods\Buphalo\Template\ActorInterface;

interface FactoryInterface
{
    public function create(): ActorInterface;
}

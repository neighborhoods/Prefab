<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Map;

use Neighborhoods\Buphalo\Template\Actor\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

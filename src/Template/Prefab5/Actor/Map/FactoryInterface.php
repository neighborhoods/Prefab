<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;

interface FactoryInterface
{
    public function create(): MapInterface;
}

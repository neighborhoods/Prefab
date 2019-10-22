<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Map\Builder;

use Neighborhoods\Buphalo\Template\Actor\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

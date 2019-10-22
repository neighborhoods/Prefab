<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Builder;

use Neighborhoods\Buphalo\Template\Actor\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

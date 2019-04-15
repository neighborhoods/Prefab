<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map\Builder;

use Neighborhoods\Bradfab\Template\Actor\Map\BuilderInterface;

interface FactoryInterface
{
    public function create(): BuilderInterface;
}

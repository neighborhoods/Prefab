<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Map;

use Neighborhoods\Buphalo\Template\Actor\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function buildForInsert(): MapInterface;

    public function setRecords(array $records): BuilderInterface;
}


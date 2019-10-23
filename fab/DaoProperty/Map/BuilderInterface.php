<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty\Map;

use Neighborhoods\Prefab\DaoProperty\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function buildForInsert(): MapInterface;

    public function setRecords(array $records): BuilderInterface;
}


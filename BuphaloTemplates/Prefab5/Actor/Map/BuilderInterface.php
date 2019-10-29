<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map;

use Neighborhoods\BuphaloTemplateTree\Actor\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function buildForInsert(): MapInterface;

    public function setRecords(array $records): BuilderInterface;
}


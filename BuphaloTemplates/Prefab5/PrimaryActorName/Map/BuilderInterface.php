<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;

interface BuilderInterface
{
    public function build(): MapInterface;

    public function buildForInsert(): MapInterface;

    public function setRecords(array $records): BuilderInterface;
}


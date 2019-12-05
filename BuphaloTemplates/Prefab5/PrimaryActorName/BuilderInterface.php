<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorNameInterface;

interface BuilderInterface
{
    public function build(): PrimaryActorNameInterface;

    public function buildForInsert(): PrimaryActorNameInterface;

    public function setRecord(array $record): BuilderInterface;
}

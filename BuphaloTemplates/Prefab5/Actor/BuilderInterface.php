<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor;

use Neighborhoods\BuphaloTemplateTree\ActorInterface;

interface BuilderInterface
{
    public function build(): ActorInterface;

    public function buildForInsert(): ActorInterface;

    public function setRecord(array $record): BuilderInterface;
}

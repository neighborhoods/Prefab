<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor;

use Neighborhoods\Buphalo\Template\ActorInterface;

interface BuilderInterface
{
    public function build(): ActorInterface;

    public function buildForInsert(): ActorInterface;

    public function setRecord(array $record): BuilderInterface;
}

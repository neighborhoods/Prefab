<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;

interface BuilderInterface
{
    public function build(): ActorInterface;

    public function setRecord(array $record): BuilderInterface;
}

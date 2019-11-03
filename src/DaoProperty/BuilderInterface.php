<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\DaoProperty;

use Neighborhoods\Prefab\DaoPropertyInterface;

interface BuilderInterface
{
    public function build(): DaoPropertyInterface;

    public function setRecord(array $record): BuilderInterface;
}

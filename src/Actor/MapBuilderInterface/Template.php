<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapBuilderInterface;

interface Template
{
    public function build() : \DAONAMEPLACEHOLDERInterface;

    public function setRecords(array $record) : \NAMESPACEPLACEHOLDER\BuilderInterface;
}

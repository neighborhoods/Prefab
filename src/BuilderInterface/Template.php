<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\BuilderInterface;

interface Template
{
    public function build() : \DAONAMEPLACEHOLDERInterface;

    public function setRecord(array $record) : \DAONAMEPLACEHOLDER\BuilderInterface;
}

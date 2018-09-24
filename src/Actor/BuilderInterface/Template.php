<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\BuilderInterface;

interface Template
{
    public function build() : \DAONAMEPLACEHOLDERInterface;

    public function setRecord(array $record) : \DAONAMEPLACEHOLDER\BuilderInterface;
}

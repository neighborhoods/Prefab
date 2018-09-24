<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Builder;

class Template
{
//    use DOANAMEPLACEHOLDER\Factory\AwareTrait;
    /** @var array */
    protected $record;

    public function build() : \DAONAMEPLACEHOLDERInterface
    {
        $TRUNCATEDDOANAMEPLACEHOLDER = $this->getTRUNCATEDDOANAMEPLACEHOLDERFactory()->create();
        // @TODO - build the object.

        return $TRUNCATEDDOANAMEPLACEHOLDER;
    }

    protected function getRecord() : array
    {
        if ($this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return $this->record;
    }

    public function setRecord(array $record) : \DAONAMEPLACEHOLDER\BuilderInterface
    {
        if ($this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        $this->record = $record;

        return $this;
    }
}

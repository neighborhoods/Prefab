<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Map;

class Template
{
    /** @param \DAONAMEPLACEHOLDERInterface ...$DAOVARNAMEPLACEHOLDERs */
    public function __construct(array $DAOVARNAMEPLACEHOLDERs = array(), int $flags = 0)
    {
        if ($this->count() !== 0) {
            throw new \LogicException('Map is not empty.');
        }

        if (!empty($DAOVARNAMEPLACEHOLDERs)) {
            $this->assertValidArrayType(...array_values($DAOVARNAMEPLACEHOLDERs));
        }

        parent::__construct($DAOVARNAMEPLACEHOLDERs, $flags);
    }

    public function offsetGet($index): \DAONAMEPLACEHOLDERInterface
    {
        return $this->assertValidArrayItemType(parent::offsetGet($index));
    }

    /** @param \DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER */
    public function offsetSet($index, $DAOVARNAMEPLACEHOLDER)
    {
        parent::offsetSet($index, $this->assertValidArrayItemType($DAOVARNAMEPLACEHOLDER));
    }

    /** @param \DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER */
    public function append($DAOVARNAMEPLACEHOLDER)
    {
        $this->assertValidArrayItemType($DAOVARNAMEPLACEHOLDER);
        parent::append($DAOVARNAMEPLACEHOLDER);
    }

    public function current(): \DAONAMEPLACEHOLDERInterface
    {
        return parent::current();
    }

    protected function assertValidArrayItemType(\DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER)
    {
        return $DAOVARNAMEPLACEHOLDER;
    }

    protected function assertValidArrayType(\DAONAMEPLACEHOLDERInterface ...$DAOVARNAMEPLACEHOLDERs): MapInterface
    {
        return $this;
    }

    public function getArrayCopy(): MapInterface
    {
        return new self(parent::getArrayCopy(), (int)$this->getFlags());
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function hydrate(array $array): MapInterface
    {
        $this->__construct($array);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapInterface;

/** @codeCoverageIgnore */
interface Template extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param \DAONAMEPLACEHOLDERInterface ...$DAOVARNAMEPLACEHOLDERs */
    public function __construct(array $DAOVARNAMEPLACEHOLDERs = array(), int $flags = 0);

    public function offsetGet($index): \DAONAMEPLACEHOLDERInterface;

    /** @param \DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER */
    public function offsetSet($index, $DAOVARNAMEPLACEHOLDER);

    /** @param \DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER */
    public function append($DAOVARNAMEPLACEHOLDER);

    public function current(): \DAONAMEPLACEHOLDERInterface;

    public function getArrayCopy(): MapInterface;

    public function toArray(): array;

    public function hydrate(array $array): MapInterface;
}

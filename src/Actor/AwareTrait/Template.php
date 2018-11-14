<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait;

/** @codeCoverageIgnore */
class Template
{
    protected $DAOVARNAMEPLACEHOLDER;

    public function setDAOVARNAMEPLACEHOLDER(\DAONAMEPLACEHOLDERInterface $DAOVARNAMEPLACEHOLDER) : \SELFPLACEHOLDER
    {
        if ($this->hasDAOVARNAMEPLACEHOLDER()) {
            throw new \LogicException('DAOVARNAMEPLACEHOLDER is already set.');
        }
        $this->DAOVARNAMEPLACEHOLDER = $DAOVARNAMEPLACEHOLDER;

        return $this;
    }

    protected function getDAOVARNAMEPLACEHOLDER() : DAONAMEPLACEHOLDERInterface
    {
        if (!$this->hasDAOVARNAMEPLACEHOLDER()) {
            throw new \LogicException('DAOVARNAMEPLACEHOLDER is not set.');
        }

        return $this->DAOVARNAMEPLACEHOLDER;
    }

    protected function hasDAOVARNAMEPLACEHOLDER() : bool
    {
        return isset($this->DAOVARNAMEPLACEHOLDER);
    }

    protected function unsetDAOVARNAMEPLACEHOLDER() : \SELFPLACEHOLDER
    {
        if (!$this->hasDAOVARNAMEPLACEHOLDER()) {
            throw new \LogicException('DAOVARNAMEPLACEHOLDER is not set.');
        }
        unset($this->DAOVARNAMEPLACEHOLDER);

        return $this;
    }
}

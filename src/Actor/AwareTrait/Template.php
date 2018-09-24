<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\AwareTrait;

/** @codeCoverageIgnore */
class Template
{
    protected $VARNAMEPLACEHOLDER;

    public function setVARNAMEPLACEHOLDER(\DAONAMEPLACEHOLDERInterface $VARNAMEPLACEHOLDER) : DAONAMEPLACEHOLDERInterface
    {
        if ($this->hasVARNAMEPLACEHOLDER()) {
            throw new \LogicException('VARNAMEPLACEHOLDER is already set.');
        }
        $this->VARNAMEPLACEHOLDER = $VARNAMEPLACEHOLDER;

        return $this;
    }

    protected function getVARNAMEPLACEHOLDER() : DAONAMEPLACEHOLDERInterface
    {
        if (!$this->hasVARNAMEPLACEHOLDER()) {
            throw new \LogicException('VARNAMEPLACEHOLDER is not set.');
        }

        return $this->VARNAMEPLACEHOLDER;
    }

    protected function hasVARNAMEPLACEHOLDER() : bool
    {
        return isset($this->VARNAMEPLACEHOLDER);
    }

    protected function unsetVARNAMEPLACEHOLDER() : DAONAMEPLACEHOLDERInterface
    {
        if (!$this->hasVARNAMEPLACEHOLDER()) {
            throw new \LogicException('VARNAMEPLACEHOLDER is not set.');
        }
        unset($this->VARNAMEPLACEHOLDER);

        return $this;
    }
}

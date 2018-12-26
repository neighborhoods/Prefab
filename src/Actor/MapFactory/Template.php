<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\MapFactory;

/** @codeCoverageIgnore */
class Template // Implements FactoryInterface
{

    // use AwareTrait

    public function create() : DAONAMEPLACEHOLDERInterface
    {
        return $this->getDAOVARNAMEPLACEHOLDER()->getArrayCopy();
    }
}

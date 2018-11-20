<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Factory;

/** @codeCoverageIgnore */
class Template // Implements FactoryInterface
{

    // use AwareTrait

    public function create() : DAONAMEPLACEHOLDERInterface
    {
        return clone $this->getDAOVARNAMEPLACEHOLDER();
    }
}

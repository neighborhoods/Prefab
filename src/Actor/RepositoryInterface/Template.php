<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface;

use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\SearchCriteriaInterface;

interface Template
{
    public function createBuilder() : \DAONAMEPLACEHOLDER\BuilderInterface;

    public function get(SearchCriteriaInterface $searchCriteria) : \DAONAMEPLACEHOLDERInterface;

    public function save(\NAMESPACEPLACEHOLDERInterface $map) : \DAONAMEPLACEHOLDER\RepositoryInterface;
}

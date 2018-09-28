<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface;

use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteriaInterface;

interface Template
{
    public function createBuilder() : \DAONAMEPLACEHOLDER\BuilderInterface;

    public function get(SearchCriteriaInterface $searchCriteria) : \DAONAMEPLACEHOLDERInterface;

    public function save(\NAMESPACEPLACEHOLDER\MapInterface $map) : \DAONAMEPLACEHOLDER\RepositoryInterface;
}

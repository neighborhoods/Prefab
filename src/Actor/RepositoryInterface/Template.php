<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\RepositoryInterface;

use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteriaInterface;

interface Template
{
    public function createBuilder() : \DAONAMEPLACEHOLDER\Map\BuilderInterface;

    public function get(SearchCriteriaInterface $searchCriteria) : \DAONAMEPLACEHOLDER\MapInterface;

    public function save(\NAMESPACEPLACEHOLDER\MapInterface $map) : \DAONAMEPLACEHOLDER\RepositoryInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\RepositoryInterface;

use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteriaInterface;

interface Template
{
    public function createBuilder() : \DAONAMEPLACEHOLDER\BuilderInterface;

    public function get(SearchCriteriaInterface $searchCriteria) : \DAONAMEPLACEHOLDER\MapInterface;

    public function save(MapInterface $map) : \DAONAMEPLACEHOLDER\RepositoryInterface;
}

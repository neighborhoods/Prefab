<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;
use PREFAB_PLACEHOLDER_VENDOR\PREFAB_PLACEHOLDER_PRODUCT\Prefab5;

interface RepositoryInterface
{
    public function get(Prefab5\SearchCriteriaInterface $searchCriteria) : MapInterface;

    public function save(MapInterface $property) : RepositoryInterface;
}

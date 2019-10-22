<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\Actor\Map;

use Neighborhoods\BuphaloTemplateTree\Actor\MapInterface;
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface-ProjectName */
interface RepositoryInterface
{
    public function get(SearchCriteriaInterface $searchCriteria) : MapInterface;

    public function save(MapInterface $property) : RepositoryInterface;
}

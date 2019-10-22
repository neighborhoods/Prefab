<?php
declare(strict_types=1);

namespace Neighborhoods\Buphalo\Template\Actor\Map;

use Neighborhoods\Buphalo\Template\Actor\MapInterface;
/** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface-ProjectName */
interface RepositoryInterface
{
    public function get(SearchCriteriaInterface $searchCriteria) : MapInterface;

    public function save(MapInterface $property) : RepositoryInterface;
}

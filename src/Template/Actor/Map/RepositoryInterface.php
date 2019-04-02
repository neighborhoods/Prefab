<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor\Map;

use Neighborhoods\Bradfab\Template\Actor\MapInterface;
/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface-ProjectName */
interface RepositoryInterface
{
    public function get(SearchCriteriaInterface $searchCriteria) : MapInterface;

    public function save(MapInterface $property) : RepositoryInterface;
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Bradfab\Template\Actor;

use Neighborhoods\Bradfab\Template\ActorInterface;
/** @neighborhoods-bradfab:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\RepositoryInterface-ProjectName */
interface RepositoryInterface
{
    public function get(SearchCriteriaInterface $searchCriteria) : MapInterface;

    public function save(ActorInterface $property) : RepositoryInterface;
}

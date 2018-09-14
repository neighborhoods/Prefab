<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Handler;


class Template // implements HandlerInterface
{
//    use DAONAMEPLACEHOLDER\Repository\AwareTrait;
//    use Neighborhoods\PROJECTNAMEPLACEHOLDER\Psr\Http\Message\ServerRequest\AwareTrait;
//    use Neighborhoods\PROJECTNAMEPLACEHOLDER\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);

        return new \Zend\Diactoros\Response\JsonResponse($this->getMap());
    }

    protected function getMap() : \NAMESPACEPLACEHOLDER\MapInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $searchCriteria = $searchCriteriaBuilder->build();

        return $this->getJakeRepository()->get($searchCriteria);
    }

    protected function getRouteResult() : \Zend\Expressive\Router\RouteResult
    {
        return $this->getPsrHttpMessageServerRequest()->getAttribute(\Zend\Expressive\Router\RouteResult::class);
    }
}

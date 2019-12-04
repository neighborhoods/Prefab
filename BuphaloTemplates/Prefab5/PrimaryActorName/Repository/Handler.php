<?php

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Repository;

use \PREFAB_PLACEHOLDER_VENDOR\PREFAB_PLACEHOLDER_PRODUCT\Prefab5;

class Handler implements HandlerInterface
{

    use \Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository\AwareTrait;
    use Prefab5\Psr\Http\Message\ServerRequest\AwareTrait;
    use Prefab5\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);
        $method = $this->getPsrHttpMessageServerRequest()->getMethod();

        if (!method_exists($this, $method)) {
            throw new \RuntimeException('Unhandled HTTP method: ' . $method);
        }

        return new \Zend\Diactoros\Response\JsonResponse($this->$method());
    }

    protected function get() : \Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $searchCriteria = $searchCriteriaBuilder->build();

        return $this->getPrimaryActorNameMapRepository()->get($searchCriteria);
    }

    protected function post()
    {

    }

    protected function put()
    {

    }

    protected function patch()
    {

    }

    protected function delete()
    {

    }

    protected function getRouteResult() : \Zend\Expressive\Router\RouteResult
    {
        return $this->getPsrHttpMessageServerRequest()->getAttribute(\Zend\Expressive\Router\RouteResult::class);
    }
}


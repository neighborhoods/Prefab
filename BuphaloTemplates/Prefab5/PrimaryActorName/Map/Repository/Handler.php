<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository;

use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Map\Repository;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\MapInterface;
use PREFAB_PLACEHOLDER_VENDOR\PREFAB_PLACEHOLDER_PRODUCT\Prefab5\HTTP\SearchCriteriaBuilderException;
use PREFAB_PLACEHOLDER_VENDOR\PREFAB_PLACEHOLDER_PRODUCT\Prefab5;

class Handler implements HandlerInterface
{

    use Repository\AwareTrait;
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

    protected function get() : MapInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        try {
            $searchCriteria = $searchCriteriaBuilder->build();
            return $this->getPrimaryActorNameMapRepository()->get($searchCriteria);
        } catch (\LogicException $exception) {
            throw new SearchCriteriaBuilderException($exception->getMessage());
        }
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


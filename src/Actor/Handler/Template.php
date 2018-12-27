<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\Actor\Handler;


class Template // implements HandlerInterface
{
//    use DAONAMEPLACEHOLDER\Repository\AwareTrait;
//    use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\Psr\Http\Message\ServerRequest\AwareTrait;
//    use Neighborhoods\PROJECTNAMEPLACEHOLDER\Prefab4\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);

        return new \Zend\Diactoros\Response\JsonResponse($this->get());
    }

    protected function get() : \PARENTNAMESPACEPLACEHOLDERInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $searchCriteria = $searchCriteriaBuilder->build();

        return $this->getDAOVARNAMEPLACEHOLDER()->get($searchCriteria);
    }

    protected function getRouteResult() : \Zend\Expressive\Router\RouteResult
    {
        return $this->getPsrHttpMessageServerRequest()->getAttribute(\Zend\Expressive\Router\RouteResult::class);
    }
}

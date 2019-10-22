<?php

namespace Neighborhoods\Buphalo\Template\Actor\Map\Repository;

class Handler implements HandlerInterface
{

    use \Neighborhoods\Buphalo\Template\Actor\Map\Repository\AwareTrait;
    /** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-ProjectName-Http\Message
     */
    /** @neighborhoods-buphalo:annotation-processor Neighborhoods\Prefab\AnnotationProcessor\Actor\Map\Repository\Handler-ProjectName-SearchCriteria
     */

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);
        $method = $this->getPsrHttpMessageServerRequest()->getMethod();

        if (!method_exists($this, $method)) {
            throw new \RuntimeException('Unhandled HTTP method: ' . $method);
        }

        return new \Zend\Diactoros\Response\JsonResponse($this->$method());
    }

    protected function get() : \Neighborhoods\Buphalo\Template\Actor\MapInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $searchCriteria = $searchCriteriaBuilder->build();

        return $this->getActorMapRepository()->get($searchCriteria);
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


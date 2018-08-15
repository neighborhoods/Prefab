#set($namespacePrefix = "")
#set($daoUpper = "")
#set($daoAllUpperHandlerContext = "")
#set($daoMapInterfaceHandlerContext = "")
#set($truncatedClassPath = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouteResult;
use ${namespacePrefix}SearchCriteria;
use ${namespacePrefix}Psr;
use ${daoMapInterfaceHandlerContext};

class Handler implements HandlerInterface
{
    use AwareTrait;
    use Psr\Http\Message\ServerRequest\AwareTrait;
    use SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(ServerRequestInterface ${DS}request): ResponseInterface
    {
        ${DS}this->setPsrHttpMessageServerRequest(${DS}request);
        ${DS}routeResult = ${DS}this->getRouteResult();
        switch (${DS}routeResult->getMatchedRouteName()) {
            case self::ROUTE_NAME_${daoAllUpperHandlerContext}S:
                ${DS}response = new JsonResponse(${DS}this->getMap());
                break;
            default:
                throw new \UnexpectedValueException('Unknown route name.');
        }

        return ${DS}response;
    }

    protected function getMap(): MapInterface
    {
        ${DS}searchCriteriaBuilder = ${DS}this->getSearchCriteriaServerRequestBuilderFactory()->create();
        ${DS}searchCriteriaBuilder->setPsrHttpMessageServerRequest(${DS}this->getPsrHttpMessageServerRequest());
        ${DS}searchCriteria = ${DS}searchCriteriaBuilder->build();
        ${DS}map = ${DS}this->get${truncatedClassPath}()->getMap(${DS}searchCriteria);

        return ${DS}map;
    }

    protected function getRouteResult(): RouteResult
    {
        return ${DS}this->getPsrHttpMessageServerRequest()->getAttribute(RouteResult::class);
    }
}

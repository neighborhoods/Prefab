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

        return new JsonResponse(${DS}this->getMap());
    }

    protected function getMap(): MapInterface
    {
        ${DS}searchCriteriaBuilder = ${DS}this->getSearchCriteriaServerRequestBuilderFactory()->create();
        ${DS}searchCriteriaBuilder->setPsrHttpMessageServerRequest(${DS}this->getPsrHttpMessageServerRequest());
        ${DS}searchCriteria = ${DS}searchCriteriaBuilder->build();

        return ${DS}this->get${truncatedClassPath}()->get(${DS}searchCriteria);
    }

    protected function getRouteResult(): RouteResult
    {
        return ${DS}this->getPsrHttpMessageServerRequest()->getAttribute(RouteResult::class);
    }
}

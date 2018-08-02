#set($namespacePrefix = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

namespace ${NAMESPACE};

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use ${namespacePrefix}Psr;

class Handler implements HandlerInterface
{
    use AwareTrait;
    use Psr\Http\Message\ServerRequest\AwareTrait;

    public function handle(ServerRequestInterface ${DS}request): ResponseInterface
    {
        // @TODO - Use the appropriate Repository method to respond.
        return new JsonResponse();
    }
}
#set($daoAllUpperHandlerContext = "")
#set($daoLowerHandlerContext = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};
#end

use Psr\Http\Server\RequestHandlerInterface;

interface HandlerInterface extends RequestHandlerInterface
{
    public const ROUTE_NAME_${daoAllUpperHandlerContext} = '${daoLowerHandlerContext}';
}

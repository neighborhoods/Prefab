#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

use ${NAMESPACE}Interface;

#end
/** @codeCoverageIgnore */
interface JITeratorInterface extends \Iterator
{
    public function current() : ${unqualifiedClassName}Interface;

    public function setGenerator(\Generator ${DS}generator) : JITeratorInterface;
}

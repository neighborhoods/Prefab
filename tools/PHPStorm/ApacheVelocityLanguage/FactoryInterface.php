#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): ${unqualifiedClassName}Interface;
}

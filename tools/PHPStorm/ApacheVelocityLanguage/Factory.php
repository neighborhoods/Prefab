#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $isArrayFactory = "$NAMESPACE.endsWith('Array')")
#set( $isMapFactory = "$NAMESPACE.endsWith('Map')")
#set($truncatedClassPath = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ${unqualifiedClassName}Interface
    {
        #if ( $isArrayFactory == "true" || $isMapFactory == "true")
        return ${DS}this->get${truncatedClassPath}()->getArrayCopy();
        #else
        return clone ${DS}this->get${truncatedClassPath}();
        #end
    }
}

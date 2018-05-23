#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $isArrayFactory = "$NAMESPACE.endsWith('Array')" )
#set($truncatedClassPath = "")
#parse("truncated classpath")
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;
use Neighborhoods\Pylon\Data;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): ${unqualifiedClassName}Interface
    {
        #if ( $isArrayFactory == "true" )
        return ${DS}this->get${truncatedClassPath}()->getArrayCopy();
        #else
        return clone ${DS}this->get${truncatedClassPath}();
        #end
    }
}

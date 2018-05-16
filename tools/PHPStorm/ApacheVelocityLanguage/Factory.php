#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $isArrayFactory = "$NAMESPACE.endsWith('Array')" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use Neighborhoods\Pylon\Data\Property\Defensive;
use ${NAMESPACE}Interface;
use Neighborhoods\Pylon\Data;

class Factory implements FactoryInterface
{
    use Defensive\AwareTrait;
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): ${unqualifiedClassName}Interface
    {
        #if ( $isArrayFactory == "true" )
        return ${DS}this->_get${targetClassVariable}()->getArrayCopy();
        #else
        return clone ${DS}this->_get${targetClassVariable}();
        #end
    }
}

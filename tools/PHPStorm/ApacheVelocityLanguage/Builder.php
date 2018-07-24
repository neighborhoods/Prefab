#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $isArrayFactory = "$NAMESPACE.endsWith('Array')")
#set( $isMapFactory = "$NAMESPACE.endsWith('Map')")
#set($truncatedClassPath = "")
#parse("truncated classpath")
#set( $elementType = "$lastPartOfNamespace" )
#set( $daoName = "$unqualifiedClassName.toLowerCase()" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;

class Builder implements BuilderInterface
{
    use Factory\AwareTrait;

    public function build(): ${unqualifiedClassName}Interface
    {
        ${DS}${daoName} = ${DS}this->get${truncatedClassPath}Factory()->create();
        // @TODO - build the DAO.

        return ${DS}${daoName};
    }
}
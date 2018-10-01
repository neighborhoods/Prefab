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

interface BuilderInterface
{
    public function build(): ${unqualifiedClassName}Interface;
    
    public function setRecord(array ${DS}record): BuilderInterface;
}
#set($truncatedClassPath = "")
#set($lastPartOfNamespace = "")
#parse("truncated classpath")
#set( $elementType = "$lastPartOfNamespace" )
#set( $arrayItemName = "$elementType.toLowerCase()" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};
use ${NAMESPACE}Interface;
#end
/** @codeCoverageIgnore */
interface ${NAME} extends \SeekableIterator, \ArrayAccess, \Serializable, \Countable
{
    /** @param ${elementType}Interface ...${DS}${arrayItemName}s */
    public function __construct(array ${DS}${arrayItemName}s = array(), int ${DS}flags = 0);

    public function offsetGet(${DS}index): ${elementType}Interface;

    /** @param ${elementType}Interface ${DS}${arrayItemName} */
    public function offsetSet(${DS}index, ${DS}${arrayItemName});

    /** @param ${elementType}Interface${DS}${arrayItemName} */
    public function append(${DS}${arrayItemName});

    public function current(): ${elementType}Interface;

    public function getArrayCopy(): $NAME;

    public function toArray() : array;

    public function hydrate(array ${DS}array) : $NAME;
}

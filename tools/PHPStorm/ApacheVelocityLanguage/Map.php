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
class ${NAME} extends \ArrayIterator implements ${NAME}Interface
{
    /** @param ${elementType}Interface ...${DS}${arrayItemName}s */
    public function __construct(array ${DS}${arrayItemName}s = array(), int ${DS}flags = 0)
    {
        if (${DS}this->count() !== 0) {
        throw new \LogicException('${NAME} is not empty.');
    }

        if (!empty(${DS}${arrayItemName}s)) {
        ${DS}this->assertValidArrayType(...array_values(${DS}${arrayItemName}s));
        }

        parent::__construct(${DS}${arrayItemName}s, ${DS}flags);
    }

    public function offsetGet(${DS}index): ${elementType}Interface
{
return ${DS}this->assertValidArrayItemType(parent::offsetGet(${DS}index));
    }

    /** @param ${elementType}Interface ${DS}${arrayItemName} */
    public function offsetSet(${DS}index, ${DS}${arrayItemName})
    {
        parent::offsetSet(${DS}index, ${DS}this->assertValidArrayItemType(${DS}${arrayItemName}));
    }

    /** @param ${elementType}Interface ${DS}${arrayItemName} */
    public function append(${DS}${arrayItemName})
    {
        ${DS}this->assertValidArrayItemType(${DS}${arrayItemName});
        parent::append(${DS}${arrayItemName});
    }

    public function current(): ${elementType}Interface
{
return parent::current();
}

    protected function assertValidArrayItemType(${elementType}Interface ${DS}${arrayItemName})
    {
        return ${DS}${arrayItemName};
    }

    protected function assertValidArrayType(${elementType}Interface ...${DS}${arrayItemName}s): ${NAME}Interface
{
return ${DS}this;
    }

    public function getArrayCopy(): ${NAME}Interface
{
return new self(parent::getArrayCopy(), (int)${DS}this->getFlags());
    }

    public function toArray() : array
{
    return (array)${DS}this;
    }

    public function hydrate(array ${DS}array) : ${NAME}Interface
{
${DS}this->__construct(${DS}array);

        return ${DS}this;
    }
}

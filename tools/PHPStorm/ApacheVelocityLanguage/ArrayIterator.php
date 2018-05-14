#set( $elementType = "$NAME.substring(0, $NAME.indexOf('Array'))" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
class ${NAME} extends \ArrayIterator implements ${NAME}Interface
{
     /** @param ${elementType}Interface ...${DS}${arrayItemName}s */
    public function __construct(array ${DS}${arrayItemName}s = array(), int ${DS}flags = 0)
    {
        if (!empty(${DS}${arrayItemName}s)) {
            ${DS}this->_assertValidArrayType(...${DS}${arrayItemName}s);
        }

        parent::__construct(${DS}${arrayItemName}s, ${DS}flags);
    }

    public function offsetGet(${DS}index): ${elementType}Interface
    {
        return ${DS}this->_assertValidArrayItemType(parent::offsetGet(${DS}index));
    }

    /** @param ${elementType}Interface ${DS}${arrayItemName} */
    public function offsetSet(${DS}index, ${DS}${arrayItemName})
    {
        parent::offsetSet(${DS}index, ${DS}this->_assertValidArrayItemType(${DS}${arrayItemName}));
    }

    /** @param ${elementType}Interface ${DS}${arrayItemName} */
    public function append(${DS}${arrayItemName})
    {
        ${DS}this->_assertValidArrayItemType(${DS}${arrayItemName});
        parent::append(${DS}${arrayItemName});
    }

    public function current(): ${elementType}Interface
    {
        return parent::current();
    }

    protected function _assertValidArrayItemType(${elementType}Interface ${DS}${arrayItemName})
    {
        return ${DS}${arrayItemName};
    }

    protected function _assertValidArrayType(${elementType}Interface ...${DS}${arrayItemName}s): ${NAME}Interface
    {
        return ${DS}this;
    }
}

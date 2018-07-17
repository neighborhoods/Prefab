#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $lowerCaseUnqualifiedClassName = "$unqualifiedClassName.substring(0,1).toLowerCase()$unqualifiedClassName.substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

use ${NAMESPACE}Interface;

#end
class Iterator implements IteratorInterface
{
    protected ${DS}internalIterator;

    public function next() : void
    {
        ${DS}this->getInternalIterator()->next();
    }

    public function current() : ${unqualifiedClassName}Interface
    {
        return ${DS}this->_assertValidArrayItemType(
            ${DS}this->getInternalIterator()->current()
        );
    }

    public function valid() : bool
    {
        return ${DS}this->getInternalIterator()->valid();
    }

    public function rewind() : void
    {
        ${DS}this->getInternalIterator()->rewind();
    }

    public function key()
    {
        return ${DS}this->getInternalIterator()->key();
    }

    protected function _assertValidArrayItemType(${unqualifiedClassName}Interface ${DS}$lowerCaseUnqualifiedClassName) : ${unqualifiedClassName}Interface
    {
        return ${DS}$lowerCaseUnqualifiedClassName;
    }

    protected function getInternalIterator() : \Iterator
    {
        if (${DS}this->internalIterator === null) {
            throw new \LogicException('`internalIterator` has not been set.');
        }
        return ${DS}this->internalIterator;
    }

    public function setInternalIterator(\Iterator ${DS}internalIterator) : IteratorInterface
    {
        if (${DS}this->internalIterator !== null) {
            throw new \LogicException('`internalIterator` already set.');
        }
        ${DS}this->internalIterator = ${DS}internalIterator;
        return ${DS}this;
    }
}


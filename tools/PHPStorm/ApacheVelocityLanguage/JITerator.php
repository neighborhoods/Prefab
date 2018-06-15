#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
#set( $lowerCaseUnqualifiedClassName = "$unqualifiedClassName.substring(0,1).toLowerCase()$unqualifiedClassName.substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

use ${NAMESPACE}Interface;

#end
/** @codeCoverageIgnore */
class JITerator implements JITeratorInterface
{
    protected ${DS}generator;

    public function next() : void
    {
        ${DS}this->getGenerator()->next();
    }

    public function current() : ${unqualifiedClassName}Interface
    {
        return ${DS}this->assertValidArrayItemType(
            ${DS}this->getGenerator()->current()
        );
    }

    public function valid() : bool
    {
        return ${DS}this->getGenerator()->valid();
    }

    public function rewind() : void
    {
        ${DS}this->getGenerator()->rewind();
    }

    public function key()
    {
        return ${DS}this->getGenerator()->key();
    }

    protected function assertValidArrayItemType(${unqualifiedClassName}Interface ${DS}$lowerCaseUnqualifiedClassName) : ${unqualifiedClassName}Interface
    {
        return ${DS}$lowerCaseUnqualifiedClassName;
    }

    protected function getGenerator() : \Generator
    {
        if (${DS}this->generator === null) {
            throw new \LogicException('Generator has not been set.');
        }
        return ${DS}this->generator;
    }

    public function setGenerator(\Generator ${DS}generator) : JITeratorInterface
    {
        if (${DS}this->generator !== null) {
            throw new \LogicException('Generator is already set.');
        }
        ${DS}this->generator = ${DS}generator;
        return ${DS}this;
    }
}

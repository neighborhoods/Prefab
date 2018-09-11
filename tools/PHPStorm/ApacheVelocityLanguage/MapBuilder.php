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
    use // Replace with reference to non-Map version of Builder\Factory\AwareTrait;
    /** @var array */
    protected ${DS}record;

    public function build(): ${unqualifiedClassName}Interface
    {
        ${DS}${daoName} = ${DS}this->get${truncatedClassPath}Factory()->create();
        // @TODO - build the object.

        return ${DS}${daoName};
    }

    protected function getRecords(): array
    {
        if (${DS}this->record === null) {
            throw new \LogicException('Builder record has not been set.');
        }

        return ${DS}this->record;
    }

    public function setRecords(array ${DS}record): BuilderInterface
    {
        if (${DS}this->record !== null) {
            throw new \LogicException('Builder record is already set.');
        }

        ${DS}this->record = ${DS}record;

        return ${DS}this;
    }
}

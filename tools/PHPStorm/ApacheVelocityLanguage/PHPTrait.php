#set($truncatedClassPath = "")
#set($awarePropertyName = "")
#parse("truncated classpath")
#set( $camelCaseArgumentName = "$truncatedClassPath.substring(0,1).toLowerCase()$truncatedClassPath.substring(1)" )
#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;
/** @codeCoverageIgnore */
trait AwareTrait
{
    protected ${DS}${awarePropertyName};

    public function set${truncatedClassPath}(${unqualifiedClassName}Interface ${DS}$camelCaseArgumentName): self
    {
        if(${DS}this->has${truncatedClassPath}()) {
            throw new \LogicException('${awarePropertyName} is already set.');
        }
        ${DS}this->${awarePropertyName} = ${DS}$camelCaseArgumentName;

        return ${DS}this;
    }

    protected function get${truncatedClassPath}(): ${unqualifiedClassName}Interface
    {
        if(!${DS}this->has${truncatedClassPath}()) {
            throw new \LogicException('${awarePropertyName} is not set.');
        }

        return ${DS}this->${awarePropertyName};
    }

    protected function has${truncatedClassPath}(): bool
    {
        return isset(${DS}this->${awarePropertyName});
    }

    protected function unset${truncatedClassPath}(): self
    {
        if(!${DS}this->has${truncatedClassPath}()) {
            throw new \LogicException('${awarePropertyName} is not set.');
        }
        unset(${DS}this->${awarePropertyName});

        return ${DS}this;
    }
}

#set( $camelCaseArgumentName = "$TargetClassName.substring(0,1).toLowerCase()$TargetClassName.substring(1)" )
#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
use ${NAMESPACE}Interface;

trait AwareTrait
{
    public function set${TargetClassName}(${unqualifiedClassName}Interface ${DS}$camelCaseArgumentName): self
    {
        ${DS}this->_create(${unqualifiedClassName}Interface::class, ${DS}$camelCaseArgumentName);

        return ${DS}this;
    }

    protected function get${TargetClassName}(): ${unqualifiedClassName}Interface
    {
        return ${DS}this->_read(${unqualifiedClassName}Interface::class);
    }

    protected function has${TargetClassName}(): bool
    {
        return ${DS}this->_exists(${unqualifiedClassName}Interface::class);
    }

    protected function unset${TargetClassName}(): self
    {
        ${DS}this->_delete(${unqualifiedClassName}Interface::class);

        return ${DS}this;
    }
}

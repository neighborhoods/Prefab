<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
class ${NAME} implements ${NAME}Interface {

    public function hydrate(array ${DS}record): ${NAME}Interface 
    {
        // @TODO
        return ${DS}this;
    }

    public function jsonSerialize()
    {
        return get_object_vars(${DS}this);
    }
}
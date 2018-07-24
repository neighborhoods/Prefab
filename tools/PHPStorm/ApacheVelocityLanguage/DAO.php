<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

#end
class ${NAME} implements ${NAME}Interface
{
    public function jsonSerialize()
    {
        return get_object_vars(${DS}this);
    }
}
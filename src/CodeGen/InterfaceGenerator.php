<?php
declare(strict_types=1);

namespace Neighborhoods\Prefab\CodeGen;

use Zend\Code\Generator\InterfaceGenerator as ZendInterfaceGenerator;

class InterfaceGenerator extends ZendInterfaceGenerator
{
    public function setExtendedClass($extendedClass)
    {
        $this->extendedClass = $extendedClass;
        return $this;
    }
}

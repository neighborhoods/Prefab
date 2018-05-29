#set( $unqualifiedClassName = "$NAMESPACE.substring($NAMESPACE.lastIndexOf('\')).substring(1)" )
<?php
declare(strict_types=1);

#if (${NAMESPACE})
namespace ${NAMESPACE};

use ${NAMESPACE}Interface;

#end
interface IteratorInterface extends \Iterator
{
    public function current() : ${unqualifiedClassName}Interface;

    public function setInternalIterator(\Iterator ${DS}internalIterator) : IteratorInterface;
}


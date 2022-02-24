<?php
declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree;

/** @neighborhoods-buphalo:annotation-processor UseNamespaces
 */

class PrimaryActorName implements PrimaryActorNameInterface
{
/** @neighborhoods-buphalo:annotation-processor DaoPropertiesAndAccessors
    // TODO: Implement properties, and accessors.
 */

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip\Update;

use Neighborhoods\Radar\V1\MV\Blip\UpdateInterface;
use Neighborhoods\Pylon\Data;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;
    use Data\Property\Defensive\AwareTrait;

    public function create(): UpdateInterface
    {
        return clone $this->getV1MVBlipUpdate();
    }
}

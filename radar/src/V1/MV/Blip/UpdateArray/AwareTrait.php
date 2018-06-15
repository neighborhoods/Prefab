<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip\UpdateArray;

use Neighborhoods\Radar\V1\MV\Blip\UpdateArrayInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarV1MVBlipUpdateArray;

    public function setV1MVBlipUpdateArray(UpdateArrayInterface $v1MVBlipUpdateArray): self
    {
        assert(!$this->hasV1MVBlipUpdateArray(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateArray is already set.'));
        $this->NeighborhoodsRadarV1MVBlipUpdateArray = $v1MVBlipUpdateArray;

        return $this;
    }

    protected function getV1MVBlipUpdateArray(): UpdateArrayInterface
    {
        assert($this->hasV1MVBlipUpdateArray(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateArray is not set.'));

        return $this->NeighborhoodsRadarV1MVBlipUpdateArray;
    }

    protected function hasV1MVBlipUpdateArray(): bool
    {
        return isset($this->NeighborhoodsRadarV1MVBlipUpdateArray);
    }

    protected function unsetV1MVBlipUpdateArray(): self
    {
        assert($this->hasV1MVBlipUpdateArray(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateArray is not set.'));
        unset($this->NeighborhoodsRadarV1MVBlipUpdateArray);

        return $this;
    }
}

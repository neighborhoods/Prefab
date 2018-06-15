<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip\Update;

use Neighborhoods\Radar\V1\MV\Blip\UpdateInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarV1MVBlipUpdate;

    public function setV1MVBlipUpdate(UpdateInterface $v1MVBlipUpdate): self
    {
        assert(!$this->hasV1MVBlipUpdate(), new \LogicException('NeighborhoodsRadarV1MVBlipUpdate is already set.'));
        $this->NeighborhoodsRadarV1MVBlipUpdate = $v1MVBlipUpdate;

        return $this;
    }

    protected function getV1MVBlipUpdate(): UpdateInterface
    {
        assert($this->hasV1MVBlipUpdate(), new \LogicException('NeighborhoodsRadarV1MVBlipUpdate is not set.'));

        return $this->NeighborhoodsRadarV1MVBlipUpdate;
    }

    protected function hasV1MVBlipUpdate(): bool
    {
        return isset($this->NeighborhoodsRadarV1MVBlipUpdate);
    }

    protected function unsetV1MVBlipUpdate(): self
    {
        assert($this->hasV1MVBlipUpdate(), new \LogicException('NeighborhoodsRadarV1MVBlipUpdate is not set.'));
        unset($this->NeighborhoodsRadarV1MVBlipUpdate);

        return $this;
    }
}

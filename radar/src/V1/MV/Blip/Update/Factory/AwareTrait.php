<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\V1\MV\Blip\Update\Factory;

use Neighborhoods\Radar\V1\MV\Blip\Update\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarV1MVBlipUpdateFactory;

    public function setV1MVBlipUpdateFactory(FactoryInterface $v1MVBlipUpdateFactory): self
    {
        assert(!$this->hasV1MVBlipUpdateFactory(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateFactory is already set.'));
        $this->NeighborhoodsRadarV1MVBlipUpdateFactory = $v1MVBlipUpdateFactory;

        return $this;
    }

    protected function getV1MVBlipUpdateFactory(): FactoryInterface
    {
        assert($this->hasV1MVBlipUpdateFactory(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateFactory is not set.'));

        return $this->NeighborhoodsRadarV1MVBlipUpdateFactory;
    }

    protected function hasV1MVBlipUpdateFactory(): bool
    {
        return isset($this->NeighborhoodsRadarV1MVBlipUpdateFactory);
    }

    protected function unsetV1MVBlipUpdateFactory(): self
    {
        assert($this->hasV1MVBlipUpdateFactory(),
            new \LogicException('NeighborhoodsRadarV1MVBlipUpdateFactory is not set.'));
        unset($this->NeighborhoodsRadarV1MVBlipUpdateFactory);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArray;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArrayInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray;

    public function setDoctrineDBALConnectionDecoratorArray(
        DecoratorArrayInterface $doctrineDBALConnectionDecoratorArray
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray is already set.'));
        $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray = $doctrineDBALConnectionDecoratorArray;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArray(): DecoratorArrayInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray is not set.'));

        return $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray;
    }

    protected function hasDoctrineDBALConnectionDecoratorArray(): bool
    {
        return isset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArray(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArray(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray is not set.'));
        unset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArray);

        return $this;
    }
}

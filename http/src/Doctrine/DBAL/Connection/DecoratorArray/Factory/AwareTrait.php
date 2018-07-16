<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArray\Factory;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorArray\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory;

    public function setDoctrineDBALConnectionDecoratorArrayFactory(
        FactoryInterface $doctrineDBALConnectionDecoratorArrayFactory
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory is already set.'));
        $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory = $doctrineDBALConnectionDecoratorArrayFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorArrayFactory(): FactoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory is not set.'));

        return $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorArrayFactory(): bool
    {
        return isset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorArrayFactory(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorArrayFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory is not set.'));
        unset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorArrayFactory);

        return $this;
    }
}

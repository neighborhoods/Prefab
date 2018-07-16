<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator\Factory;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory;

    public function setDoctrineDBALConnectionDecoratorFactory(FactoryInterface $doctrineDBALConnectionDecoratorFactory
    ): self {
        assert(!$this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory is already set.'));
        $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory = $doctrineDBALConnectionDecoratorFactory;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecoratorFactory(): FactoryInterface
    {
        assert($this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory is not set.'));

        return $this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory;
    }

    protected function hasDoctrineDBALConnectionDecoratorFactory(): bool
    {
        return isset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory);
    }

    protected function unsetDoctrineDBALConnectionDecoratorFactory(): self
    {
        assert($this->hasDoctrineDBALConnectionDecoratorFactory(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory is not set.'));
        unset($this->NeighborhoodsRadarDoctrineDBALConnectionDecoratorFactory);

        return $this;
    }
}

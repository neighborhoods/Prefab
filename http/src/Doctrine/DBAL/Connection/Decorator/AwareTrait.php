<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\Doctrine\DBAL\Connection\Decorator;

use Neighborhoods\Radar\Doctrine\DBAL\Connection\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarDoctrineDBALConnectionDecorator;

    public function setDoctrineDBALConnectionDecorator(DecoratorInterface $doctrineDBALConnectionDecorator): self
    {
        assert(!$this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecorator is already set.'));
        $this->NeighborhoodsRadarDoctrineDBALConnectionDecorator = $doctrineDBALConnectionDecorator;

        return $this;
    }

    protected function getDoctrineDBALConnectionDecorator(): DecoratorInterface
    {
        assert($this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecorator is not set.'));

        return $this->NeighborhoodsRadarDoctrineDBALConnectionDecorator;
    }

    protected function hasDoctrineDBALConnectionDecorator(): bool
    {
        return isset($this->NeighborhoodsRadarDoctrineDBALConnectionDecorator);
    }

    protected function unsetDoctrineDBALConnectionDecorator(): self
    {
        assert($this->hasDoctrineDBALConnectionDecorator(),
            new \LogicException('NeighborhoodsRadarDoctrineDBALConnectionDecorator is not set.'));
        unset($this->NeighborhoodsRadarDoctrineDBALConnectionDecorator);

        return $this;
    }
}

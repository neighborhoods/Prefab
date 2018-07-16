<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\PDO\Builder\Factory;

use Neighborhoods\Radar\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarPDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        assert(!$this->hasPDOBuilderFactory(),
            new \LogicException('NeighborhoodsRadarPDOBuilderFactory is already set.'));
        $this->NeighborhoodsRadarPDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        assert($this->hasPDOBuilderFactory(), new \LogicException('NeighborhoodsRadarPDOBuilderFactory is not set.'));

        return $this->NeighborhoodsRadarPDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsRadarPDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        assert($this->hasPDOBuilderFactory(), new \LogicException('NeighborhoodsRadarPDOBuilderFactory is not set.'));
        unset($this->NeighborhoodsRadarPDOBuilderFactory);

        return $this;
    }
}

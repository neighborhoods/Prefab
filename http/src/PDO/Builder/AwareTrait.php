<?php
declare(strict_types=1);

namespace Neighborhoods\Radar\PDO\Builder;

use Neighborhoods\Radar\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsRadarPDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        assert(!$this->hasPDOBuilder(), new \LogicException('NeighborhoodsRadarPDOBuilder is already set.'));
        $this->NeighborhoodsRadarPDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        assert($this->hasPDOBuilder(), new \LogicException('NeighborhoodsRadarPDOBuilder is not set.'));

        return $this->NeighborhoodsRadarPDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->NeighborhoodsRadarPDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        assert($this->hasPDOBuilder(), new \LogicException('NeighborhoodsRadarPDOBuilder is not set.'));
        unset($this->NeighborhoodsRadarPDOBuilder);

        return $this;
    }
}

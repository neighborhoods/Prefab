<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServicePDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        if ($this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilder is already set.');
        }
        $this->NeighborhoodsAreaServicePDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilder is not set.');
        }

        return $this->NeighborhoodsAreaServicePDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->NeighborhoodsAreaServicePDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilder is not set.');
        }
        unset($this->NeighborhoodsAreaServicePDOBuilder);

        return $this;
    }
}

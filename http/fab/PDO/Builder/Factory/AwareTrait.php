<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServicePDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        if ($this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilderFactory is already set.');
        }
        $this->NeighborhoodsAreaServicePDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilderFactory is not set.');
        }

        return $this->NeighborhoodsAreaServicePDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsAreaServicePDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsAreaServicePDOBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsAreaServicePDOBuilderFactory);

        return $this;
    }
}

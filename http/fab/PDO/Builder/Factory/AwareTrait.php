<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory;

    public function setPDOBuilderFactory(FactoryInterface $pDOBuilderFactory): self
    {
        if ($this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory = $pDOBuilderFactory;

        return $this;
    }

    protected function getPDOBuilderFactory(): FactoryInterface
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory;
    }

    protected function hasPDOBuilderFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory);
    }

    protected function unsetPDOBuilderFactory(): self
    {
        if (!$this->hasPDOBuilderFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilderFactory);

        return $this;
    }
}

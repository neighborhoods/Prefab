<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\Builder;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\PDO\BuilderInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder;

    public function setPDOBuilder(BuilderInterface $pDOBuilder): self
    {
        if ($this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder = $pDOBuilder;

        return $this;
    }

    protected function getPDOBuilder(): BuilderInterface
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder;
    }

    protected function hasPDOBuilder(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder);
    }

    protected function unsetPDOBuilder(): self
    {
        if (!$this->hasPDOBuilder()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPDOBuilder);

        return $this;
    }
}

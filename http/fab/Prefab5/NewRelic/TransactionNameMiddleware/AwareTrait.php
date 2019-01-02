<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddlewareInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware;

    public function setNewRelicTransactionNameMiddleware(
        TransactionNameMiddlewareInterface $newRelicTransactionNameMiddleware
    ): self {
        if ($this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware = $newRelicTransactionNameMiddleware;

        return $this;
    }

    protected function getNewRelicTransactionNameMiddleware(): TransactionNameMiddlewareInterface
    {
        if (!$this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware;
    }

    protected function hasNewRelicTransactionNameMiddleware(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware);
    }

    protected function unsetNewRelicTransactionNameMiddleware(): self
    {
        if (!$this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware);

        return $this;
    }
}

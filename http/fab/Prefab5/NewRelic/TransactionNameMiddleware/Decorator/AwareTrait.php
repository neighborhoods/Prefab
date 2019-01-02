<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator;

    public function setNewRelicTransactionNameMiddlewareDecorator(
        DecoratorInterface $newRelicTransactionNameMiddlewareDecorator
    ): self {
        if ($this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator = $newRelicTransactionNameMiddlewareDecorator;

        return $this;
    }

    protected function getNewRelicTransactionNameMiddlewareDecorator(): DecoratorInterface
    {
        if (!$this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator;
    }

    protected function hasNewRelicTransactionNameMiddlewareDecorator(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator);
    }

    protected function unsetNewRelicTransactionNameMiddlewareDecorator(): self
    {
        if (!$this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator);

        return $this;
    }
}

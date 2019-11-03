<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware\Decorator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator;

    public function setNewRelicTransactionNameMiddlewareDecorator(
        DecoratorInterface $newRelicTransactionNameMiddlewareDecorator
    ): self {
        if ($this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator = $newRelicTransactionNameMiddlewareDecorator;

        return $this;
    }

    protected function getNewRelicTransactionNameMiddlewareDecorator(): DecoratorInterface
    {
        if (!$this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator;
    }

    protected function hasNewRelicTransactionNameMiddlewareDecorator(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator);
    }

    protected function unsetNewRelicTransactionNameMiddlewareDecorator(): self
    {
        if (!$this->hasNewRelicTransactionNameMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddlewareDecorator);

        return $this;
    }
}

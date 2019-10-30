<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddleware;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\NewRelic\TransactionNameMiddlewareInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware;

    public function setNewRelicTransactionNameMiddleware(
        TransactionNameMiddlewareInterface $newRelicTransactionNameMiddleware
    ): self {
        if ($this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware = $newRelicTransactionNameMiddleware;

        return $this;
    }

    protected function getNewRelicTransactionNameMiddleware(): TransactionNameMiddlewareInterface
    {
        if (!$this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware;
    }

    protected function hasNewRelicTransactionNameMiddleware(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware);
    }

    protected function unsetNewRelicTransactionNameMiddleware(): self
    {
        if (!$this->hasNewRelicTransactionNameMiddleware()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductNewRelicTransactionNameMiddleware);

        return $this;
    }
}

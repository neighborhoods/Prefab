<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS\ErrorHandler;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS\ErrorHandlerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler;

    public function setOpcacheDNSErrorHandler(ErrorHandlerInterface $opcacheDNSErrorHandler): self
    {
        if ($this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler = $opcacheDNSErrorHandler;

        return $this;
    }

    protected function getOpcacheDNSErrorHandler(): ErrorHandlerInterface
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler;
    }

    protected function hasOpcacheDNSErrorHandler(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler);
    }

    protected function unsetOpcacheDNSErrorHandler(): self
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler);

        return $this;
    }
}

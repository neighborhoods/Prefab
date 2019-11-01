<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS\Factory;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory;

    public function setOpcacheDNSFactory(FactoryInterface $opcacheDNSFactory): self
    {
        if ($this->hasOpcacheDNSFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory = $opcacheDNSFactory;

        return $this;
    }

    protected function getOpcacheDNSFactory(): FactoryInterface
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory;
    }

    protected function hasOpcacheDNSFactory(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory);
    }

    protected function unsetOpcacheDNSFactory(): self
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNSFactory);

        return $this;
    }
}

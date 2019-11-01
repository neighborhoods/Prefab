<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNS;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Opcache\DNSInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS;

    public function setOpcacheDNS(DNSInterface $opcacheDNS): self
    {
        if ($this->hasOpcacheDNS()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS = $opcacheDNS;

        return $this;
    }

    protected function getOpcacheDNS(): DNSInterface
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS;
    }

    protected function hasOpcacheDNS(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS);
    }

    protected function unsetOpcacheDNS(): self
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductOpcacheDNS);

        return $this;
    }
}

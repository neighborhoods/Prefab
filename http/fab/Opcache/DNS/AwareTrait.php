<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNSInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServiceOpcacheDNS;

    public function setOpcacheDNS(DNSInterface $opcacheDNS): self
    {
        if ($this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNS is already set.');
        }
        $this->NeighborhoodsAreaServiceOpcacheDNS = $opcacheDNS;

        return $this;
    }

    protected function getOpcacheDNS(): DNSInterface
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNS is not set.');
        }

        return $this->NeighborhoodsAreaServiceOpcacheDNS;
    }

    protected function hasOpcacheDNS(): bool
    {
        return isset($this->NeighborhoodsAreaServiceOpcacheDNS);
    }

    protected function unsetOpcacheDNS(): self
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNS is not set.');
        }
        unset($this->NeighborhoodsAreaServiceOpcacheDNS);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNSInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS;

    public function setOpcacheDNS(DNSInterface $opcacheDNS): self
    {
        if ($this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS = $opcacheDNS;

        return $this;
    }

    protected function getOpcacheDNS(): DNSInterface
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS;
    }

    protected function hasOpcacheDNS(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS);
    }

    protected function unsetOpcacheDNS(): self
    {
        if (!$this->hasOpcacheDNS()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNS);

        return $this;
    }
}

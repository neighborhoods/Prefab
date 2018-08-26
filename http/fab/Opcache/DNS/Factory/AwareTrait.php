<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServiceOpcacheDNSFactory;

    public function setOpcacheDNSFactory(FactoryInterface $opcacheDNSFactory): self
    {
        if ($this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSFactory is already set.');
        }
        $this->NeighborhoodsAreaServiceOpcacheDNSFactory = $opcacheDNSFactory;

        return $this;
    }

    protected function getOpcacheDNSFactory(): FactoryInterface
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSFactory is not set.');
        }

        return $this->NeighborhoodsAreaServiceOpcacheDNSFactory;
    }

    protected function hasOpcacheDNSFactory(): bool
    {
        return isset($this->NeighborhoodsAreaServiceOpcacheDNSFactory);
    }

    protected function unsetOpcacheDNSFactory(): self
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSFactory is not set.');
        }
        unset($this->NeighborhoodsAreaServiceOpcacheDNSFactory);

        return $this;
    }
}

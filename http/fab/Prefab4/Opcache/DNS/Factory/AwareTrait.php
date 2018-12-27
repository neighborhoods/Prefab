<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Opcache\DNS\Factory;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Opcache\DNS\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory;

    public function setOpcacheDNSFactory(FactoryInterface $opcacheDNSFactory): self
    {
        if ($this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory = $opcacheDNSFactory;

        return $this;
    }

    protected function getOpcacheDNSFactory(): FactoryInterface
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory;
    }

    protected function hasOpcacheDNSFactory(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory);
    }

    protected function unsetOpcacheDNSFactory(): self
    {
        if (!$this->hasOpcacheDNSFactory()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSFactory);

        return $this;
    }
}

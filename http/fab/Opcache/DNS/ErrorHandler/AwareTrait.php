<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS\ErrorHandler;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Opcache\DNS\ErrorHandlerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServiceOpcacheDNSErrorHandler;

    public function setOpcacheDNSErrorHandler(ErrorHandlerInterface $opcacheDNSErrorHandler): self
    {
        if ($this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSErrorHandler is already set.');
        }
        $this->NeighborhoodsAreaServiceOpcacheDNSErrorHandler = $opcacheDNSErrorHandler;

        return $this;
    }

    protected function getOpcacheDNSErrorHandler(): ErrorHandlerInterface
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSErrorHandler is not set.');
        }

        return $this->NeighborhoodsAreaServiceOpcacheDNSErrorHandler;
    }

    protected function hasOpcacheDNSErrorHandler(): bool
    {
        return isset($this->NeighborhoodsAreaServiceOpcacheDNSErrorHandler);
    }

    protected function unsetOpcacheDNSErrorHandler(): self
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsAreaServiceOpcacheDNSErrorHandler is not set.');
        }
        unset($this->NeighborhoodsAreaServiceOpcacheDNSErrorHandler);

        return $this;
    }
}

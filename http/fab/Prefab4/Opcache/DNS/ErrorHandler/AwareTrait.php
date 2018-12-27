<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Opcache\DNS\ErrorHandler;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\Opcache\DNS\ErrorHandlerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler;

    public function setOpcacheDNSErrorHandler(ErrorHandlerInterface $opcacheDNSErrorHandler): self
    {
        if ($this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler = $opcacheDNSErrorHandler;

        return $this;
    }

    protected function getOpcacheDNSErrorHandler(): ErrorHandlerInterface
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler;
    }

    protected function hasOpcacheDNSErrorHandler(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler);
    }

    protected function unsetOpcacheDNSErrorHandler(): self
    {
        if (!$this->hasOpcacheDNSErrorHandler()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductOpcacheDNSErrorHandler);

        return $this;
    }
}

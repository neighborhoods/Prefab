<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Psr\Http\Message\ServerRequest;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Psr\Http\Message\ServerRequestInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest;

    public function setPsrHttpMessageServerRequest(ServerRequestInterface $psrHttpMessageServerRequest): self
    {
        if ($this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest = $psrHttpMessageServerRequest;

        return $this;
    }

    protected function getPsrHttpMessageServerRequest(): ServerRequestInterface
    {
        if (!$this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest;
    }

    protected function hasPsrHttpMessageServerRequest(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest);
    }

    protected function unsetPsrHttpMessageServerRequest(): self
    {
        if (!$this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPsrHttpMessageServerRequest);

        return $this;
    }
}

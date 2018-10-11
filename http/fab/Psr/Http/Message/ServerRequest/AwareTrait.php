<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Psr\Http\Message\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $PsrHttpMessageServerRequest;

    public function setPsrHttpMessageServerRequest(ServerRequestInterface $psrHttpMessageServerRequest): self
    {
        if ($this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('PsrHttpMessageServerRequest is already set.');
        }
        $this->PsrHttpMessageServerRequest = $psrHttpMessageServerRequest;

        return $this;
    }

    protected function getPsrHttpMessageServerRequest(): ServerRequestInterface
    {
        if (!$this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('PsrHttpMessageServerRequest is not set.');
        }

        return $this->PsrHttpMessageServerRequest;
    }

    protected function hasPsrHttpMessageServerRequest(): bool
    {
        return isset($this->PsrHttpMessageServerRequest);
    }

    protected function unsetPsrHttpMessageServerRequest(): self
    {
        if (!$this->hasPsrHttpMessageServerRequest()) {
            throw new \LogicException('PsrHttpMessageServerRequest is not set.');
        }
        unset($this->PsrHttpMessageServerRequest);

        return $this;
    }
}

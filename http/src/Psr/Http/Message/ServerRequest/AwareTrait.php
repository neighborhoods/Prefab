<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Psr\Http\Message\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $PsrHttpMessageServerRequest;

    public function setPsrHttpMessageServerRequest(ServerRequestInterface $psrHttpMessageServerRequest): self
    {
        assert(!$this->hasPsrHttpMessageServerRequest(),
            new \LogicException('PsrHttpMessageServerRequest is already set.'));
        $this->PsrHttpMessageServerRequest = $psrHttpMessageServerRequest;

        return $this;
    }

    protected function getPsrHttpMessageServerRequest(): ServerRequestInterface
    {
        assert($this->hasPsrHttpMessageServerRequest(),
            new \LogicException('PsrHttpMessageServerRequest is not set.'));

        return $this->PsrHttpMessageServerRequest;
    }

    protected function hasPsrHttpMessageServerRequest(): bool
    {
        return isset($this->PsrHttpMessageServerRequest);
    }

    protected function unsetPsrHttpMessageServerRequest(): self
    {
        assert($this->hasPsrHttpMessageServerRequest(),
            new \LogicException('PsrHttpMessageServerRequest is not set.'));
        unset($this->PsrHttpMessageServerRequest);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware;

use Zend\ProblemDetails\ProblemDetailsMiddleware;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ZendProblemDetailsProblemDetailsMiddleware;

    public function setZendProblemDetailsProblemDetailsMiddleware(
        ProblemDetailsMiddleware $zendProblemDetailsProblemDetailsMiddleware
    ): self {
        if ($this->hasZendProblemDetailsProblemDetailsMiddleware()) {
            throw new \LogicException('ZendProblemDetailsProblemDetailsMiddleware is already set.');
        }
        $this->ZendProblemDetailsProblemDetailsMiddleware = $zendProblemDetailsProblemDetailsMiddleware;

        return $this;
    }

    protected function getZendProblemDetailsProblemDetailsMiddleware(): ProblemDetailsMiddleware
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddleware()) {
            throw new \LogicException('ZendProblemDetailsProblemDetailsMiddleware is not set.');
        }

        return $this->ZendProblemDetailsProblemDetailsMiddleware;
    }

    protected function hasZendProblemDetailsProblemDetailsMiddleware(): bool
    {
        return isset($this->ZendProblemDetailsProblemDetailsMiddleware);
    }

    protected function unsetZendProblemDetailsProblemDetailsMiddleware(): self
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddleware()) {
            throw new \LogicException('ZendProblemDetailsProblemDetailsMiddleware is not set.');
        }
        unset($this->ZendProblemDetailsProblemDetailsMiddleware);

        return $this;
    }
}

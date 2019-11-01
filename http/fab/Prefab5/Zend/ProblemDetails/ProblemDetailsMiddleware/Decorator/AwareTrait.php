<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware\Decorator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator;

    public function setZendProblemDetailsProblemDetailsMiddlewareDecorator(
        DecoratorInterface $zendProblemDetailsProblemDetailsMiddlewareDecorator
    ): self {
        if ($this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator = $zendProblemDetailsProblemDetailsMiddlewareDecorator;

        return $this;
    }

    protected function getZendProblemDetailsProblemDetailsMiddlewareDecorator(): DecoratorInterface
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator;
    }

    protected function hasZendProblemDetailsProblemDetailsMiddlewareDecorator(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator);
    }

    protected function unsetZendProblemDetailsProblemDetailsMiddlewareDecorator(): self
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator);

        return $this;
    }
}

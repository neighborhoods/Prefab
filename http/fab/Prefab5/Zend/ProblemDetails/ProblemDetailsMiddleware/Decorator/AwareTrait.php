<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\ProblemDetails\ProblemDetailsMiddleware\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator;

    public function setZendProblemDetailsProblemDetailsMiddlewareDecorator(
        DecoratorInterface $zendProblemDetailsProblemDetailsMiddlewareDecorator
    ): self {
        if ($this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator = $zendProblemDetailsProblemDetailsMiddlewareDecorator;

        return $this;
    }

    protected function getZendProblemDetailsProblemDetailsMiddlewareDecorator(): DecoratorInterface
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator;
    }

    protected function hasZendProblemDetailsProblemDetailsMiddlewareDecorator(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator);
    }

    protected function unsetZendProblemDetailsProblemDetailsMiddlewareDecorator(): self
    {
        if (!$this->hasZendProblemDetailsProblemDetailsMiddlewareDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendProblemDetailsProblemDetailsMiddlewareDecorator);

        return $this;
    }
}

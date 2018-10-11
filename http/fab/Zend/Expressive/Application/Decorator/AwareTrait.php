<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Zend\Expressive\Application\Decorator;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Zend\Expressive\Application\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator;

    public function setZendExpressiveApplicationDecorator(DecoratorInterface $zendExpressiveApplicationDecorator): self
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator = $zendExpressiveApplicationDecorator;

        return $this;
    }

    protected function getZendExpressiveApplicationDecorator(): DecoratorInterface
    {
        if (!$this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator;
    }

    protected function hasZendExpressiveApplicationDecorator(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator);
    }

    protected function unsetZendExpressiveApplicationDecorator(): self
    {
        if (!$this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator);

        return $this;
    }
}

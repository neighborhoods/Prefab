<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\Expressive\Application\Decorator;

use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\Expressive\Application\DecoratorInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator;

    public function setZendExpressiveApplicationDecorator(DecoratorInterface $zendExpressiveApplicationDecorator): self
    {
        if ($this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is already set.');
        }
        $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator = $zendExpressiveApplicationDecorator;

        return $this;
    }

    protected function getZendExpressiveApplicationDecorator(): DecoratorInterface
    {
        if (!$this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is not set.');
        }

        return $this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator;
    }

    protected function hasZendExpressiveApplicationDecorator(): bool
    {
        return isset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator);
    }

    protected function unsetZendExpressiveApplicationDecorator(): self
    {
        if (!$this->hasZendExpressiveApplicationDecorator()) {
            throw new \LogicException('ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator is not set.');
        }
        unset($this->ReplaceThisWithTheNameOfYourVendorReplaceThisWithTheNameOfYourProductZendExpressiveApplicationDecorator);

        return $this;
    }
}

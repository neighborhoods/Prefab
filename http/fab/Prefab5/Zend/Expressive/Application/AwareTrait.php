<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\Zend\Expressive\Application;

use Zend\Expressive\Application;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $ZendExpressiveApplication;

    public function setZendExpressiveApplication(Application $zendExpressiveApplication): self
    {
        if ($this->hasZendExpressiveApplication()) {
            throw new \LogicException('ZendExpressiveApplication is already set.');
        }
        $this->ZendExpressiveApplication = $zendExpressiveApplication;

        return $this;
    }

    protected function getZendExpressiveApplication(): Application
    {
        if (!$this->hasZendExpressiveApplication()) {
            throw new \LogicException('ZendExpressiveApplication is not set.');
        }

        return $this->ZendExpressiveApplication;
    }

    protected function hasZendExpressiveApplication(): bool
    {
        return isset($this->ZendExpressiveApplication);
    }

    protected function unsetZendExpressiveApplication(): self
    {
        if (!$this->hasZendExpressiveApplication()) {
            throw new \LogicException('ZendExpressiveApplication is not set.');
        }
        unset($this->ZendExpressiveApplication);

        return $this;
    }
}

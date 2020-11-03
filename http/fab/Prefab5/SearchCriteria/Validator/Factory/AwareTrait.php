<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Factory;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\FactoryInterface;

trait AwareTrait
{
    protected $ValidatorFactory;

    public function setValidatorFactory(FactoryInterface $ValidatorFactory): self
    {
        if ($this->hasValidatorFactory()) {
            throw new LogicException('ValidatorFactory is already set.');
        }
        $this->ValidatorFactory = $ValidatorFactory;

        return $this;
    }

    protected function getValidatorFactory(): FactoryInterface
    {
        if (!$this->hasValidatorFactory()) {
            throw new LogicException('ValidatorFactory is not set.');
        }

        return $this->ValidatorFactory;
    }

    protected function hasValidatorFactory(): bool
    {
        return isset($this->ValidatorFactory);
    }

    protected function unsetValidatorFactory(): self
    {
        if (!$this->hasValidatorFactory()) {
            throw new LogicException('ValidatorFactory is not set.');
        }
        unset($this->ValidatorFactory);

        return $this;
    }
}

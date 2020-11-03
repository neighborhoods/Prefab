<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Builder\Factory;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $ValidatorBuilderFactory;

    public function setValidatorBuilderFactory(FactoryInterface $ValidatorBuilderFactory): self
    {
        if ($this->hasValidatorBuilderFactory()) {
            throw new LogicException('ValidatorBuilderFactory is already set.');
        }
        $this->ValidatorBuilderFactory = $ValidatorBuilderFactory;

        return $this;
    }

    protected function getValidatorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasValidatorBuilderFactory()) {
            throw new LogicException('ValidatorBuilderFactory is not set.');
        }

        return $this->ValidatorBuilderFactory;
    }

    protected function hasValidatorBuilderFactory(): bool
    {
        return isset($this->ValidatorBuilderFactory);
    }

    protected function unsetValidatorBuilderFactory(): self
    {
        if (!$this->hasValidatorBuilderFactory()) {
            throw new LogicException('ValidatorBuilderFactory is not set.');
        }
        unset($this->ValidatorBuilderFactory);

        return $this;
    }
}

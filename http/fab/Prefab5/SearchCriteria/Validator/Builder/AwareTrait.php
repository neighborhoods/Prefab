<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Builder;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\BuilderInterface;

trait AwareTrait
{
    protected $ValidatorBuilder;

    public function setValidatorBuilder(BuilderInterface $ValidatorBuilder): self
    {
        if ($this->hasValidatorBuilder()) {
            throw new LogicException('ValidatorBuilder is already set.');
        }
        $this->ValidatorBuilder = $ValidatorBuilder;

        return $this;
    }

    protected function getValidatorBuilder(): BuilderInterface
    {
        if (!$this->hasValidatorBuilder()) {
            throw new LogicException('ValidatorBuilder is not set.');
        }

        return $this->ValidatorBuilder;
    }

    protected function hasValidatorBuilder(): bool
    {
        return isset($this->ValidatorBuilder);
    }

    protected function unsetValidatorBuilder(): self
    {
        if (!$this->hasValidatorBuilder()) {
            throw new LogicException('ValidatorBuilder is not set.');
        }
        unset($this->ValidatorBuilder);

        return $this;
    }
}

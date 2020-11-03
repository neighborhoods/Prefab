<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\Decorator;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator\DecoratorInterface;

trait AwareTrait
{
    protected $ValidatorDecorator;

    public function setValidatorDecorator(DecoratorInterface $Decorator): self
    {
        if ($this->hasValidatorDecorator()) {
            throw new LogicException('ValidatorDecorator is already set.');
        }
        $this->ValidatorDecorator = $Decorator;

        return $this;
    }

    protected function getValidatorDecorator(): DecoratorInterface
    {
        if (!$this->hasValidatorDecorator()) {
            throw new LogicException('ValidatorDecorator is not set.');
        }

        return $this->ValidatorDecorator;
    }

    protected function hasValidatorDecorator(): bool
    {
        return isset($this->ValidatorDecorator);
    }

    protected function unsetValidatorDecorator(): self
    {
        if (!$this->hasValidatorDecorator()) {
            throw new LogicException('ValidatorDecorator is not set.');
        }
        unset($this->ValidatorDecorator);

        return $this;
    }
}

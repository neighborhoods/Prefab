<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\Validator;

use LogicException;
use ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria\ValidatorInterface;

trait AwareTrait
{
    protected $Validator;

    public function setValidator(ValidatorInterface $Validator): self
    {
        if ($this->hasValidator()) {
            throw new LogicException('Validator is already set.');
        }
        $this->Validator = $Validator;

        return $this;
    }

    protected function getValidator(): ValidatorInterface
    {
        if (!$this->hasValidator()) {
            throw new LogicException('Validator is not set.');
        }

        return $this->Validator;
    }

    protected function hasValidator(): bool
    {
        return isset($this->Validator);
    }

    protected function unsetValidator(): self
    {
        if (!$this->hasValidator()) {
            throw new LogicException('Validator is not set.');
        }
        unset($this->Validator);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace ReplaceThisWithTheNameOfYourVendor\ReplaceThisWithTheNameOfYourProduct\Prefab5\SearchCriteria;

class Filter implements FilterInterface
{
    /** @var string */
    protected $field;
    /** @var array */
    protected $values;
    /** @var string */
    protected $condition;
    /** @var string */
    protected $glue;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getField(): string
    {
        if ($this->field === null) {
            throw new \LogicException('Filter field has not been set.');
        }

        return $this->field;
    }

    public function setField(string $field): FilterInterface
    {
        if ($this->field !== null) {
            throw new \LogicException('Filter field is already set.');
        }
        $this->field = $field;

        return $this;
    }

    public function getValues(): array
    {
        if ($this->values === null) {
            throw new \LogicException('Filter values has not been set.');
        }

        return $this->values;
    }

    public function setValues(array $values): FilterInterface
    {
        if ($this->values !== null) {
            throw new \LogicException('Filter values is already set.');
        }
        $this->values = $values;

        return $this;
    }

    public function getCondition(): string
    {
        if ($this->condition === null) {
            throw new \LogicException('Filter condition has not been set.');
        }

        return $this->condition;
    }

    public function setCondition(string $condition): FilterInterface
    {
        if ($this->condition !== null) {
            throw new \LogicException('Filter condition is already set.');
        }
        $this->condition = $condition;

        return $this;
    }

    public function getGlue(): string
    {
        if ($this->glue === null) {
            throw new \LogicException('Filter glue has not been set.');
        }

        return $this->glue;
    }

    public function setGlue(string $glue): FilterInterface
    {
        if ($this->glue !== null) {
            throw new \LogicException('Filter glue is already set.');
        }
        $this->glue = $glue;

        return $this;
    }
}

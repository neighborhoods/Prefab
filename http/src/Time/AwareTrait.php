<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Time;

use neighborhoods\~~PROJECT NAME~~\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~Time;

    public function setTime(TimeInterface $time): self
    {
        assert(!$this->hasTime(), new \LogicException('Neighborhoods~~PROJECT NAME~~Time is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~Time = $time;

        return $this;
    }

    protected function getTime(): TimeInterface
    {
        assert($this->hasTime(), new \LogicException('Neighborhoods~~PROJECT NAME~~Time is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~Time;
    }

    protected function hasTime(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~Time);
    }

    protected function unsetTime(): self
    {
        assert($this->hasTime(), new \LogicException('Neighborhoods~~PROJECT NAME~~Time is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~Time);

        return $this;
    }
}

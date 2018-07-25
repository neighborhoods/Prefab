<?php
declare(strict_types=1);

namespace Neighborhoods\~\Time;

use Neighborhoods\~\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~Time;

    public function setTime(TimeInterface $time): self
    {
        assert(!$this->hasTime(), new \LogicException('Neighborhoods~Time is already set.'));
        $this->Neighborhoods~Time = $time;

        return $this;
    }

    protected function getTime(): TimeInterface
    {
        assert($this->hasTime(), new \LogicException('Neighborhoods~Time is not set.'));

        return $this->Neighborhoods~Time;
    }

    protected function hasTime(): bool
    {
        return isset($this->Neighborhoods~Time);
    }

    protected function unsetTime(): self
    {
        assert($this->hasTime(), new \LogicException('Neighborhoods~Time is not set.'));
        unset($this->Neighborhoods~Time);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Time;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductTime;

    public function setTime(TimeInterface $time): self
    {
        if ($this->hasTime()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductTime is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductTime = $time;

        return $this;
    }

    protected function getTime(): TimeInterface
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductTime is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductTime;
    }

    protected function hasTime(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductTime);
    }

    protected function unsetTime(): self
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductTime is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductTime);

        return $this;
    }
}

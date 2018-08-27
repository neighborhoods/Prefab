<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelicInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsAreaServiceNewRelic;

    public function setNewRelic(NewRelicInterface $newRelic): self
    {
        if ($this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsAreaServiceNewRelic is already set.');
        }
        $this->NeighborhoodsAreaServiceNewRelic = $newRelic;

        return $this;
    }

    protected function getNewRelic(): NewRelicInterface
    {
        if (!$this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsAreaServiceNewRelic is not set.');
        }

        return $this->NeighborhoodsAreaServiceNewRelic;
    }

    protected function hasNewRelic(): bool
    {
        return isset($this->NeighborhoodsAreaServiceNewRelic);
    }

    protected function unsetNewRelic(): self
    {
        if (!$this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsAreaServiceNewRelic is not set.');
        }
        unset($this->NeighborhoodsAreaServiceNewRelic);

        return $this;
    }
}

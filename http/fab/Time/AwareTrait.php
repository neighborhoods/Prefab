<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Time;

use Neighborhoods\PrefabExamplesFunction41\TimeInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41Time;

    public function setTime(TimeInterface $time): self
    {
        if ($this->hasTime()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41Time is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41Time = $time;

        return $this;
    }

    protected function getTime(): TimeInterface
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41Time is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41Time;
    }

    protected function hasTime(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41Time);
    }

    protected function unsetTime(): self
    {
        if (!$this->hasTime()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41Time is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41Time);

        return $this;
    }
}

<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\NewRelic;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab4\NewRelicInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic;

    public function setNewRelic(NewRelicInterface $newRelic): self
    {
        if ($this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic = $newRelic;

        return $this;
    }

    protected function getNewRelic(): NewRelicInterface
    {
        if (!$this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic;
    }

    protected function hasNewRelic(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic);
    }

    protected function unsetNewRelic(): self
    {
        if (!$this->hasNewRelic()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductNewRelic);

        return $this;
    }
}

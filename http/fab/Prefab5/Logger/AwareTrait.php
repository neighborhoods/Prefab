<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\Logger;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Prefab5\LoggerInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger;

    public function setPrefab5Logger(LoggerInterface $prefab5Logger) : self
    {
        if ($this->hasPrefab5Logger()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger = $prefab5Logger;

        return $this;
    }

    protected function getPrefab5Logger() : LoggerInterface
    {
        if (!$this->hasPrefab5Logger()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger;
    }

    protected function hasPrefab5Logger() : bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger);
    }

    protected function unsetPrefab5Logger() : self
    {
        if (!$this->hasPrefab5Logger()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductPrefab5Logger);

        return $this;
    }
}

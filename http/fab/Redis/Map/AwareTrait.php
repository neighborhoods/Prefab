<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Map;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap;

    public function setRedisMap(MapInterface $redisMap): self
    {
        if ($this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap = $redisMap;

        return $this;
    }

    protected function getRedisMap(): MapInterface
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap;
    }

    protected function hasRedisMap(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap);
    }

    protected function unsetRedisMap(): self
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisMap);

        return $this;
    }
}

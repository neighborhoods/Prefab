<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Map;

use Neighborhoods\PrefabExamplesFunction41\Redis\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41RedisMap;

    public function setRedisMap(MapInterface $redisMap): self
    {
        if ($this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMap is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41RedisMap = $redisMap;

        return $this;
    }

    protected function getRedisMap(): MapInterface
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMap is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41RedisMap;
    }

    protected function hasRedisMap(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41RedisMap);
    }

    protected function unsetRedisMap(): self
    {
        if (!$this->hasRedisMap()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMap is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41RedisMap);

        return $this;
    }
}

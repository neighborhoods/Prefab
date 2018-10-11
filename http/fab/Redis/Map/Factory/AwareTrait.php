<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Map\Factory;

use Neighborhoods\PrefabExamplesFunction41\Redis\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41RedisMapFactory;

    public function setRedisMapFactory(FactoryInterface $redisMapFactory): self
    {
        if ($this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMapFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41RedisMapFactory = $redisMapFactory;

        return $this;
    }

    protected function getRedisMapFactory(): FactoryInterface
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMapFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41RedisMapFactory;
    }

    protected function hasRedisMapFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41RedisMapFactory);
    }

    protected function unsetRedisMapFactory(): self
    {
        if (!$this->hasRedisMapFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisMapFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41RedisMapFactory);

        return $this;
    }
}

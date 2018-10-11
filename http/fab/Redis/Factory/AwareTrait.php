<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Factory;

use Neighborhoods\PrefabExamplesFunction41\Redis\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41RedisFactory;

    public function setRedisFactory(FactoryInterface $redisFactory): self
    {
        if ($this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisFactory is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41RedisFactory = $redisFactory;

        return $this;
    }

    protected function getRedisFactory(): FactoryInterface
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisFactory is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41RedisFactory;
    }

    protected function hasRedisFactory(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41RedisFactory);
    }

    protected function unsetRedisFactory(): self
    {
        if (!$this->hasRedisFactory()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisFactory is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41RedisFactory);

        return $this;
    }
}

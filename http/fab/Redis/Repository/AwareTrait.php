<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabExamplesFunction41\Redis\Repository;

use Neighborhoods\PrefabExamplesFunction41\Redis\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsPrefabExamplesFunction41RedisRepository;

    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        if ($this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisRepository is already set.');
        }
        $this->NeighborhoodsPrefabExamplesFunction41RedisRepository = $redisRepository;

        return $this;
    }

    protected function getRedisRepository(): RepositoryInterface
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisRepository is not set.');
        }

        return $this->NeighborhoodsPrefabExamplesFunction41RedisRepository;
    }

    protected function hasRedisRepository(): bool
    {
        return isset($this->NeighborhoodsPrefabExamplesFunction41RedisRepository);
    }

    protected function unsetRedisRepository(): self
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsPrefabExamplesFunction41RedisRepository is not set.');
        }
        unset($this->NeighborhoodsPrefabExamplesFunction41RedisRepository);

        return $this;
    }
}

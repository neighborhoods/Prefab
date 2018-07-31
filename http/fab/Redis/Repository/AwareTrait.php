<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\Repository;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Redis\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository;

    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        if ($this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository is already set.');
        }
        $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository = $redisRepository;

        return $this;
    }

    protected function getRedisRepository(): RepositoryInterface
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository is not set.');
        }

        return $this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository;
    }

    protected function hasRedisRepository(): bool
    {
        return isset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository);
    }

    protected function unsetRedisRepository(): self
    {
        if (!$this->hasRedisRepository()) {
            throw new \LogicException('NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository is not set.');
        }
        unset($this->NeighborhoodsReplaceThisWithTheNameOfYourProductRedisRepository);

        return $this;
    }
}

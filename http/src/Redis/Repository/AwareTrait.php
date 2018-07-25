<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Repository;

use neighborhoods\~~PROJECT NAME~~\Redis\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~RedisRepository;

    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        assert(!$this->hasRedisRepository(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisRepository is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~RedisRepository = $redisRepository;

        return $this;
    }

    protected function getRedisRepository(): RepositoryInterface
    {
        assert($this->hasRedisRepository(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisRepository is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~RedisRepository;
    }

    protected function hasRedisRepository(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~RedisRepository);
    }

    protected function unsetRedisRepository(): self
    {
        assert($this->hasRedisRepository(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisRepository is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~RedisRepository);

        return $this;
    }
}

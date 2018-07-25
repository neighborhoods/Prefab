<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis\Repository;

use Neighborhoods\~\Redis\RepositoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~RedisRepository;

    public function setRedisRepository(RepositoryInterface $redisRepository): self
    {
        assert(!$this->hasRedisRepository(), new \LogicException('Neighborhoods~RedisRepository is already set.'));
        $this->Neighborhoods~RedisRepository = $redisRepository;

        return $this;
    }

    protected function getRedisRepository(): RepositoryInterface
    {
        assert($this->hasRedisRepository(), new \LogicException('Neighborhoods~RedisRepository is not set.'));

        return $this->Neighborhoods~RedisRepository;
    }

    protected function hasRedisRepository(): bool
    {
        return isset($this->Neighborhoods~RedisRepository);
    }

    protected function unsetRedisRepository(): self
    {
        assert($this->hasRedisRepository(), new \LogicException('Neighborhoods~RedisRepository is not set.'));
        unset($this->Neighborhoods~RedisRepository);

        return $this;
    }
}

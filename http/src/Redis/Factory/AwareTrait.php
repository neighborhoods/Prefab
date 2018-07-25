<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis\Factory;

use Neighborhoods\~\Redis\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~RedisFactory;

    public function setRedisFactory(FactoryInterface $redisFactory): self
    {
        assert(!$this->hasRedisFactory(), new \LogicException('Neighborhoods~RedisFactory is already set.'));
        $this->Neighborhoods~RedisFactory = $redisFactory;

        return $this;
    }

    protected function getRedisFactory(): FactoryInterface
    {
        assert($this->hasRedisFactory(), new \LogicException('Neighborhoods~RedisFactory is not set.'));

        return $this->Neighborhoods~RedisFactory;
    }

    protected function hasRedisFactory(): bool
    {
        return isset($this->Neighborhoods~RedisFactory);
    }

    protected function unsetRedisFactory(): self
    {
        assert($this->hasRedisFactory(), new \LogicException('Neighborhoods~RedisFactory is not set.'));
        unset($this->Neighborhoods~RedisFactory);

        return $this;
    }
}

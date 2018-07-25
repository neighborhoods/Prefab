<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Factory;

use neighborhoods\~~PROJECT NAME~~\Redis\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~RedisFactory;

    public function setRedisFactory(FactoryInterface $redisFactory): self
    {
        assert(!$this->hasRedisFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisFactory is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~RedisFactory = $redisFactory;

        return $this;
    }

    protected function getRedisFactory(): FactoryInterface
    {
        assert($this->hasRedisFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisFactory is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~RedisFactory;
    }

    protected function hasRedisFactory(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~RedisFactory);
    }

    protected function unsetRedisFactory(): self
    {
        assert($this->hasRedisFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisFactory is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~RedisFactory);

        return $this;
    }
}

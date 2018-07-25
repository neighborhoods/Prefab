<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Map\Factory;

use neighborhoods\~~PROJECT NAME~~\Redis\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~RedisMapFactory;

    public function setRedisMapFactory(FactoryInterface $redisMapFactory): self
    {
        assert(!$this->hasRedisMapFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMapFactory is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~RedisMapFactory = $redisMapFactory;

        return $this;
    }

    protected function getRedisMapFactory(): FactoryInterface
    {
        assert($this->hasRedisMapFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMapFactory is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~RedisMapFactory;
    }

    protected function hasRedisMapFactory(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~RedisMapFactory);
    }

    protected function unsetRedisMapFactory(): self
    {
        assert($this->hasRedisMapFactory(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMapFactory is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~RedisMapFactory);

        return $this;
    }
}

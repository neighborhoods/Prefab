<?php
declare(strict_types=1);

namespace neighborhoods\~~PROJECT NAME~~\Redis\Map;

use neighborhoods\~~PROJECT NAME~~\Redis\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~~PROJECT NAME~~RedisMap;

    public function setRedisMap(MapInterface $redisMap): self
    {
        assert(!$this->hasRedisMap(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMap is already set.'));
        $this->Neighborhoods~~PROJECT NAME~~RedisMap = $redisMap;

        return $this;
    }

    protected function getRedisMap(): MapInterface
    {
        assert($this->hasRedisMap(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMap is not set.'));

        return $this->Neighborhoods~~PROJECT NAME~~RedisMap;
    }

    protected function hasRedisMap(): bool
    {
        return isset($this->Neighborhoods~~PROJECT NAME~~RedisMap);
    }

    protected function unsetRedisMap(): self
    {
        assert($this->hasRedisMap(), new \LogicException('Neighborhoods~~PROJECT NAME~~RedisMap is not set.'));
        unset($this->Neighborhoods~~PROJECT NAME~~RedisMap);

        return $this;
    }
}

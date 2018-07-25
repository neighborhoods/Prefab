<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis\Map;

use Neighborhoods\~\Redis\MapInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~RedisMap;

    public function setRedisMap(MapInterface $redisMap): self
    {
        assert(!$this->hasRedisMap(), new \LogicException('Neighborhoods~RedisMap is already set.'));
        $this->Neighborhoods~RedisMap = $redisMap;

        return $this;
    }

    protected function getRedisMap(): MapInterface
    {
        assert($this->hasRedisMap(), new \LogicException('Neighborhoods~RedisMap is not set.'));

        return $this->Neighborhoods~RedisMap;
    }

    protected function hasRedisMap(): bool
    {
        return isset($this->Neighborhoods~RedisMap);
    }

    protected function unsetRedisMap(): self
    {
        assert($this->hasRedisMap(), new \LogicException('Neighborhoods~RedisMap is not set.'));
        unset($this->Neighborhoods~RedisMap);

        return $this;
    }
}

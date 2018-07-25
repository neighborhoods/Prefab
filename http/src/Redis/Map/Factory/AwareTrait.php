<?php
declare(strict_types=1);

namespace Neighborhoods\~\Redis\Map\Factory;

use Neighborhoods\~\Redis\Map\FactoryInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $Neighborhoods~RedisMapFactory;

    public function setRedisMapFactory(FactoryInterface $redisMapFactory): self
    {
        assert(!$this->hasRedisMapFactory(), new \LogicException('Neighborhoods~RedisMapFactory is already set.'));
        $this->Neighborhoods~RedisMapFactory = $redisMapFactory;

        return $this;
    }

    protected function getRedisMapFactory(): FactoryInterface
    {
        assert($this->hasRedisMapFactory(), new \LogicException('Neighborhoods~RedisMapFactory is not set.'));

        return $this->Neighborhoods~RedisMapFactory;
    }

    protected function hasRedisMapFactory(): bool
    {
        return isset($this->Neighborhoods~RedisMapFactory);
    }

    protected function unsetRedisMapFactory(): self
    {
        assert($this->hasRedisMapFactory(), new \LogicException('Neighborhoods~RedisMapFactory is not set.'));
        unset($this->Neighborhoods~RedisMapFactory);

        return $this;
    }
}
